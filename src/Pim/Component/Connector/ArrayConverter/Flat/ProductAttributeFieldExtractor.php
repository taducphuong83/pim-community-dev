<?php

namespace Pim\Component\Connector\ArrayConverter\Flat;

use Pim\Bundle\CatalogBundle\Model\AttributeInterface;
use Pim\Bundle\CatalogBundle\Repository\AttributeRepositoryInterface;
use Pim\Bundle\CatalogBundle\Repository\ChannelRepositoryInterface;
use Pim\Bundle\CatalogBundle\Repository\LocaleRepositoryInterface;

/**
 * Extracts attribute field information
 *
 * @author    Romain Monceau <romain@akeneo.com>
 * @copyright 2014 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class ProductAttributeFieldExtractor
{
    const ARRAY_SEPARATOR = ',';
    const FIELD_SEPARATOR = '-';
    const UNIT_SEPARATOR  = ' ';

    /** @var AttributeRepositoryInterface */
    protected $attributeRepository;

    /** @var ChannelRepositoryInterface */
    protected $channelRepository;

    /** @var LocaleRepositoryInterface */
    protected $localeRepository;

    /**
     * @param AttributeRepositoryInterface $attributeRepository
     * @param ChannelRepositoryInterface   $channelRepository
     * @param LocaleRepositoryInterface    $localeRepository
     */
    public function __construct(
        AttributeRepositoryInterface $attributeRepository,
        ChannelRepositoryInterface $channelRepository,
        LocaleRepositoryInterface $localeRepository
    ) {
        $this->attributeRepository = $attributeRepository;
        $this->channelRepository   = $channelRepository;
        $this->localeRepository    = $localeRepository;
    }

    /**
     * Extract attribute field name information with attribute code, locale code, scope code
     * and optionally price currency
     *
     * Returned array like:
     * [
     *     "attribute"   => AttributeInterface,
     *     "locale_code" => <locale_code>|null,
     *     "scope_code"  => <scope_code>|null,
     *     "price_currency" => <currency_code> // this key is optional
     * ]
     *
     * Return null if the field name does not match an attribute.
     *
     * @param string $fieldName
     *
     * @return array|null
     */
    public function extractAttributeFieldNameInfos($fieldName)
    {
        $explodedFieldName = explode(self::FIELD_SEPARATOR, $fieldName);
        $attributeCode = $explodedFieldName[0];
        $attribute = $this->attributeRepository->findOneByIdentifier($attributeCode);

        if (null !== $attribute) {
            $this->checkFieldNameTokens($attribute, $fieldName, $explodedFieldName);
            $attributeInfo = $this->extractAttributeInfo($attribute, $explodedFieldName);
            $this->checkFieldNameLocaleByChannel($attribute, $fieldName, $attributeInfo);

            return $attributeInfo;
        }

        return null;
    }

    /**
     * Extract information from an attribute and exploded field name
     * This method is used from extractAttributeFieldNameInfos and can be redefine to add new rules
     *
     * @param AttributeInterface $attribute
     * @param array              $explodedFieldName
     *
     * @return array
     */
    protected function extractAttributeInfo(AttributeInterface $attribute, array $explodedFieldName)
    {
        array_shift($explodedFieldName);

        $info = [
            'attribute'   => $attribute,
            'locale_code' => $attribute->isLocalizable() ? array_shift($explodedFieldName) : null,
            'scope_code'  => $attribute->isScopable() ? array_shift($explodedFieldName) : null,
        ];

        if ('prices' === $attribute->getBackendType()) {
            $info['price_currency'] = array_shift($explodedFieldName);
        } elseif ('metric' === $attribute->getBackendType()) {
            // TODO: has been added
            $info['metric_unit'] = array_shift($explodedFieldName);
        }

        return $info;
    }

    /**
     * Check the consistency of the field with the attribute and it properties locale, scope, currency
     *
     * @param AttributeInterface $attribute
     * @param string             $fieldName
     * @param array              $explodedFieldName
     *
     * @throws \InvalidArgumentException
     */
    protected function checkFieldNameTokens(AttributeInterface $attribute, $fieldName, array $explodedFieldName)
    {
        // the expected number of tokens in a field may vary,
        //  - with the current price import, the currency can be optionally present in the header,
        //  - with the current metric import, a "-unit" field can be added in the header,
        //
        // To avoid BC break, we keep the support in this fix, a next minor version could contain only the
        // support of currency code in the header and metric in a single field
        $isLocalizable = $attribute->isLocalizable();
        $isScopable = $attribute->isScopable();
        $isPrice = 'prices' === $attribute->getBackendType();
        $isMetric = 'metric' === $attribute->getBackendType();

        $expectedSize = 1;
        $expectedSize = $isLocalizable ? $expectedSize + 1 : $expectedSize;
        $expectedSize = $isScopable ? $expectedSize + 1 : $expectedSize;

        if ($isMetric || $isPrice) {
            $expectedSize = [$expectedSize, $expectedSize + 1];
        } else {
            $expectedSize = [$expectedSize];
        }

        $nbTokens = count($explodedFieldName);
        if (!in_array($nbTokens, $expectedSize)) {
            $expected = [
                $isLocalizable ? 'a locale' : 'no locale',
                $isScopable ? 'a scope' : 'no scope',
                $isPrice ? 'an optional currency' : 'no currency',
            ];
            $expected = implode($expected, ', ');

            throw new \InvalidArgumentException(
                sprintf(
                    'The field "%s" is not well-formatted, attribute "%s" expects %s',
                    $fieldName,
                    $attribute->getCode(),
                    $expected
                )
            );
        }
        if ($isLocalizable) {
            $this->checkForLocaleSpecificValue($attribute, $explodedFieldName);
        }
    }

    /**
     * Check the consistency of the field with channel associated
     *
     * @param AttributeInterface $attribute
     * @param string             $fieldName
     * @param array              $attributeInfo
     *
     * @throws \InvalidArgumentException
     */
    protected function checkFieldNameLocaleByChannel(AttributeInterface $attribute, $fieldName, array $attributeInfo)
    {
        if ($attribute->isScopable() &&
            $attribute->isLocalizable() &&
            isset($attributeInfo['scope_code']) &&
            isset($attributeInfo['locale_code'])
        ) {
            $channel = $this->channelRepository->findOneByIdentifier($attributeInfo['scope_code']);
            $locale = $this->localeRepository->findOneByIdentifier($attributeInfo['locale_code']);

            if ($channel !== null && $locale !== null && !$channel->hasLocale($locale)) {
                throw new \InvalidArgumentException(
                    sprintf(
                        'The locale "%s" of the field "%s" is not available in scope "%s"',
                        $attributeInfo['locale_code'],
                        $fieldName,
                        $attributeInfo['scope_code']
                    )
                );
            }
        }
    }

    /**
     * Check if provided locales for an locale specific attribute exist
     *
     * @param AttributeInterface $attribute
     * @param array              $explodedFieldNames
     */
    protected function checkForLocaleSpecificValue(AttributeInterface $attribute, array $explodedFieldNames)
    {
        if ($attribute->isLocaleSpecific()) {
            $attributeInfo = $this->extractAttributeInfo($attribute, $explodedFieldNames);
            $availableLocales = $attribute->getLocaleSpecificCodes();
            if (!in_array($explodedFieldNames[1], $availableLocales)) {
                throw new \LogicException(
                    sprintf(
                        'The provided specific locale "%s" does not exist for "%s" attribute ',
                        $attributeInfo['locale_code'],
                        $attribute->getCode()
                    )
                );
            }
        }
    }
}
