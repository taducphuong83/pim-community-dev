# 1.7.x

## Bug fixes

- PIM-6207: correctly dismiss "Unsaved changes" message on system configuration

# 1.7.0 (2017-03-14)

## Functional improvements

- API-84: As Julia, I would like to list/get/download a media file
- API-85: As Julia, I would like to create a media file
- API-76: As Julia, I would like to list locales
- API-31: As Julia, I would like to list attribute options
- API-126: Change attribute form "scope" input to a yes/no switch

## Bug Fixes

- PIM-6210: fix unused fields on import profiles
- PIM-6203: Fix various design bugs
- PIM-6200: Only the owner of a view can save and remove it.

## BC breaks

### Methods

- Remove `getApi` and `setApi` methods from `Pim\Bundle\UserBundle\Entity\UserInterface`

### Classes

- Remove class `Oro\Bundle\UserBundle\Entity\UserApi`
- Remove class `Oro\Bundle\UserBundle\Form\EventListener\UserApiSubscriber`
- Remove class `Oro\Bundle\UserBundle\Form\Type\UserApiType`
- Remove class `Oro\Bundle\UserBundle\Command\GenerateWSSEHeaderCommand`
- Remove class `Oro\Bundle\UserBundle\Security\WsseAuthListener`
- Remove class `Oro\Bundle\UserBundle\Security\WsseUserProvider`
- Remove Class `Pim\Bundle\UserBundle\Security\WsseUserProvider`

# 1.7.0-BETA2 (2017-03-06)

# 1.7.0-BETA1 (2017-03-02)

## Functional improvements

- AMS-27: Add badges next to fields to inform the user that the field need to be filled.

## Web API

- API-47: Use OAuth2 to authenticate users on the web API
- API-48: As Peter, I would like to generate client_id and secret keys for OAuth2
- API-63: As Peter, I would like to manage who can access to the web API
- API-18: As Julia, I would like to list and filter products
- API-9: As Julia, I would like to get/create/update/delete a product
- API-16: As Julia, I would like to list families
- API-23: As Julia, I would like to get/create/update a family
- API-15: As Julia, I would like to list attributes
- API-22: As Julia, I would like to get/create/update an attribute
- API-17: As Julia, I would like to list categories
- API-29: As Julia, I would like to get/create/update a category
- API-75: As Julia, I would like to list channels
- API-77: As Filips, I would like to discover all routes in the API

# 1.7.0-ALPHA1 (2017-02-23)

## Bug Fixes

- PIM-6161: Fix Tooltips and errors rendering on Import/Export Builder
- GITHUB-5038: Fixed job name visibility checker to also check additional config
- GITHUB-5062: Fixed unit conversion for ElectricCharge, cheers @gplanchat!
- GITHUB-5294: Fixed infinite loading if no attribute is configured as a product identifier, cheers @gplanchat!
- GITHUB-5337: Fixed Widget Registry. Priority is now taken in account.
- PIM-6127: In the family import, the attributes required should be in the family
- PIM-6125: In the family import, the attribute_as_label has to be in the family and its type has to be identifier or text
- GITHUB-4772: Switching between tabs of family edit form removes newly added attributes

## Functional improvements

- PIM-6106: As Peter, I would like to remove the escape parameter not usefull in the XLSX connector
- PIM-6081: As Julia, when I use a multiselect filter in a grid, I would like to automatically unchecked ALL
- PIM-6058: As Julia, I would like to define as default a view I have not created
- PIM-6090: As Julia, I would like to see my dashboard according to my rights
- PIM-6093: As Peter, I would like to know the imports/exports or mass actions with warnings
- PIM-6088: As Julia, I would like to change the view per page by default to 25
- PIM-6052: As Julia, I would like to use filters "is not empty" in the product grid
- PIM-6075: As Julia, I would like to view the asset thumbnail in the proposals
- Change the loading message by a more humanized message to share our love.
- Add Energy measure family and conversions cheers @JulienDotDev!
- Complete Duration measure family with week, month, year and related conversions cheers @JulienDotDev!
- Add CaseBox measure family and conversions, cheers @gplanchat!
- Add history support for the channel conversion units.
- Add warning count on export execution grid and dashboard
- Add not empty filter operator on product grid and product export builder
- PIM-6095: Selector on family attribute's tab to add all attributes of an attribute group

## Technical improvements

- TIP-682: Update to Symfony 2.7.23
- TIP-666: Implement BEM methodology for CSS
- TIP-575: Rename FileIterator classes to FlatFileIterator and changes the reader/processor behavior to iterate over the item's position in the file instead of the item's line number in the file.
- TIP-662: Removed the WITH_REQUIRED_IDENTIFIER option from `Pim\Component\Connector\ArrayConverter\FlatToStandard\Product` as it was not used anymore.
- TIP-667: Introduce a product value factory service to instanciate product values.
- TIP-652: Redo the import/export screens in new PEF architecture
- GITHUB-5380: Add `Pim\Component\User\Model\GroupInterface`
- GITHUB-4696: Ping the server before updating job and step execution data to prevent "MySQL Server has gone away" issue cheers @qrz-io!
- GITHUB-5391: Redo association type edit form using backbonejs architecture and internal REST API
- GITHUB-5455: Redo channel edit form using backbonejs architecture and internal REST API, implement `Pim\Bundle\CatalogBundle\Doctrine\Common\Remover\ChannelRemover` and move validation logic from controller to newly created remover
- GITHUB-5573: Redo family edit form using backbonejs architecture and internal REST API, implement `Pim\Bundle\EnrichBundle\Doctrine\ORM\Repository\AttributeGroupSearchableRepository`

## Deprecations

- In the _Product Query Builder_, aka _PQB_, (`Pim\Component\Catalog\Query\ProductQueryBuilderInterface`), filtering products by the following filters is now deprecated: `categories.id`, `family.id`, `groups.id`.
  Filters `categories`, `family` and `groups` have been introduced and the _PQB_ now uses them by default. The filters `categories.code`, `family.code` and `groups.code` are deprecated.
  In the next version, the deprecated filters will be removed.
- As it's not needed anymore to convert `codes` to `ids` in order to filter products, `Pim\Bundle\CatalogBundle\Doctrine\Common\Filter\ObjectIdResolver` and `Pim\Bundle\CatalogBundle\Doctrine\Common\Filter\ObjectIdResolverInterface` are now deprecated.
- Creating a product value with the ProductBuilder (`Pim\Component\Catalog\Denormalizer\Standard\ProductValueDenormalizer`) using the `createProductValue` method is now deprecated. It is advised to use the ProductValueFactory (`Pim\Component\Catalog\Factory\ProductValueFactory`) instead.
- `Pim\Component\Catalog\Model\AttributeInterface::setAttributeType()` has been deprecated in favor of `Pim\Component\Catalog\Model\AttributeInterface::setType()`
- `Pim\Component\Catalog\Model\AttributeInterface::getAttributeType()` has been deprecated in favor of `Pim\Component\Catalog\Model\AttributeInterface::getType()`

## BC breaks

### Bundles

- Remove deprecated bundle `Pim\Bundle\WebServiceBundle\PimWebServiceBundle`
- Remove deprecated bundle `Oro\Bundle\UIBundle\OroUIBundle`
- Remove deprecated bundle `Oro\Bundle\FormBundle\OroFormBundle`

### Routing

- Change route from `pim_user_user_rest_get` to `pim_user_user_rest_get_current`. Route `pim_user_user_rest_get` now fetch a user the given username.
- Change route `pim_enrich_channel_edit` to use `code` identifier instead of `id`
- Change association type route to use `code` instead of `id` for fetching

### Dependency Injection

- Remove services `oro_user.role_manager` and `oro_user.group_manager`
- Remove services `pim_enrich.form.view.view_updater.registry` and `pim_enrich.form.view.view_updater.variant`
- Remove service and parameter: `pim_enrich_image` and `pim_enrich.form.type.image.class`
- Rename service `pim_serializer.normalizer.job_instance` to `pim_catalog.normalizer.standard.job_instance`
- Rename service `pim_connector.array_converter.structured.job_instance` to `pim_connector.array_converter.standard.job_instance`
- Rename service `pim_serializer.normalizer.association_type` to `pim_catalog.normalizer.standard.association_type`
- Rename service `pim_serializer.normalizer.attribute` to `pim_catalog.normalizer.standard.attribute`
- Rename service `pim_serializer.normalizer.attribute_group` to `pim_catalog.normalizer.standard.attribute_group`
- Rename service `pim_serializer.normalizer.attribute_option` to `pim_catalog.normalizer.standard.attribute_option`
- Rename service `pim_serializer.normalizer.category` to `pim_catalog.normalizer.standard.category`
- Rename service `pim_serializer.normalizer.channel` to `pim_catalog.normalizer.standard.channel`
- Rename service `pim_serializer.normalizer.datetime` to `pim_catalog.normalizer.standard.datetime`
- Rename service `pim_serializer.normalizer.family` to `pim_catalog.normalizer.standard.family`
- Rename service `pim_serializer.normalizer.group` to `pim_catalog.normalizer.standard.proxy_group`
- Rename service `pim_serializer.normalizer.product` to `pim_catalog.normalizer.standard.product`
- Rename service `pim_serializer.normalizer.product_properties` to `pim_catalog.normalizer.standard.product.properties`
- Rename service `pim_serializer.normalizer.product_associations` to `pim_catalog.normalizer.standard.product.associations`
- Rename service `pim_serializer.normalizer.product_values` to `pim_catalog.normalizer.standard.product.product_values`
- Rename service `pim_serializer.normalizer.product_value` to `pim_catalog.normalizer.standard.product.product_value`
- Rename service `pim_serializer.normalizer.product_price` to `pim_catalog.normalizer.standard.product.price`
- Rename service `pim_serializer.normalizer.metric` to `pim_catalog.normalizer.standard.product.metric`
- Rename service `pim_serializer.normalizer.file` to `pim_catalog.normalizer.standard.file`
- Rename service `pim_serializer.normalizer.currency` to `pim_catalog.normalizer.standard.currency`
- Rename service `pim_serializer.normalizer.group_type` to `pim_catalog.normalizer.standard.group_type`
- Rename service `pim_serializer.normalizer.locale` to `pim_catalog.normalizer.standard.locale`
- Rename service `pim_serializer.normalizer.label_translation` to `pim_catalog.normalizer.standard.translation`
- Rename service `pim_serializer.normalizer.comment` to `pim_comment.normalizer.standard.comment`


### Classes

- Remove class `Pim\Component\ReferenceData\Normalizer\Structured\ReferenceDataNormalizer`
- Remove class `Oro\Bundle\UserBundle\Entity\Manager\GroupManager`
- Remove class `Oro\Bundle\UserBundle\Entity\Manager\RoleManager`
- Remove class `Pim\Bundle\ImportExportBundle\DependencyInjection\Compiler\RegisterJobNameVisibilityCheckerPass`
- Remove class `Pim\Bundle\ImportExportBundle\DependencyInjection\Compiler\RegisterJobParametersFormsOptionsPass`
- Remove class `Pim\Bundle\ImportExportBundle\DependencyInjection\Compiler\RegisterJobParametersModelTransformersPass`
- Remove class `Pim\Bundle\ImportExportBundle\DependencyInjection\Compiler\RegisterJobTemplatePass`
- Remove class `Pim\Bundle\ImportExportBundle\Form\DataTransformer\ConfigurationToJobParametersTransformer`
- Remove class `Pim\Bundle\ImportExportBundle\Form\Type\JobParameter\LocaleChoiceType`
- Remove class `Pim\Bundle\ImportExportBundle\Form\Type\JobParametersType`
- Remove class `Pim\Bundle\ImportExportBundle\JobParameters\FormConfigurationProvider\ProductCsvExport`
- Remove class `Pim\Bundle\ImportExportBundle\JobParameters\FormConfigurationProvider\ProductCsvImport`
- Remove class `Pim\Bundle\ImportExportBundle\JobParameters\FormConfigurationProvider\ProductXlsxExport`
- Remove class `Pim\Bundle\ImportExportBundle\JobParameters\FormConfigurationProvider\SimpleCsvExport`
- Remove class `Pim\Bundle\ImportExportBundle\JobParameters\FormConfigurationProvider\SimpleCsvImport`
- Remove class `Pim\Bundle\ImportExportBundle\JobParameters\FormConfigurationProvider\SimpleXlsxExport`
- Remove class `Pim\Bundle\ImportExportBundle\JobParameters\FormConfigurationProvider\SimpleXlsxImport`
- Remove class `Pim\Bundle\ImportExportBundle\JobParameters\FormConfigurationProvider\SimpleYamlExport`
- Remove class `Pim\Bundle\ImportExportBundle\JobParameters\FormConfigurationProvider\SimpleYamlImport`
- Remove class `Pim\Bundle\ImportExportBundle\JobParameters\FormConfigurationProvider\VariantGroupCsvExport`
- Remove class `Pim\Bundle\ImportExportBundle\JobParameters\FormConfigurationProvider\VariantGroupCsvImport`
- Remove class `Pim\Bundle\ImportExportBundle\JobParameters\FormConfigurationProvider\VariantGroupXlsxExport`
- Remove class `Pim\Bundle\ImportExportBundle\JobParameters\FormConfigurationProviderInterface`
- Remove class `Pim\Bundle\ImportExportBundle\JobParameters\FormConfigurationProviderRegistry`
- Remove class `Pim\Bundle\ImportExportBundle\JobTemplate\JobTemplateProvider`
- Remove class `Pim\Bundle\ImportExportBundle\JobTemplate\JobTemplateProviderInterface`
- Remove class `Pim\Bundle\ImportExportBundle\Twig\NormalizeConfigurationExtension`
- Remove class `Pim\Bundle\ImportExportBundle\ViewElement\Checker\JobNameVisibilityChecker`
- Remove class `Pim\Bundle\EnrichBundle\DependencyInjection\Compiler\RegisterViewUpdatersPass`
- Remove class `Pim\Bundle\EnrichBundle\Form\View\ProductFormViewInterface`
- Remove class `Pim\Bundle\EnrichBundle\Form\View\ViewUpdater\VariantViewUpdater`
- Remove class `Pim\Bundle\EnrichBundle\Form\View\ViewUpdater\ViewUpdaterInterface`
- Remove class `Pim\Bundle\EnrichBundle\Form\View\ViewUpdater\ViewUpdaterRegistry`
- Remove class `Pim\Bundle\EnrichBundle\Form\Type\ProductCreateType`
- Remove class `Pim\Bundle\EnrichBundle\Form\Type\ChannelType`
- Remove class `Pim\Bundle\EnrichBundle\Form\Type\ConversionUnitsType`
- Remove class `Pim\Bundle\NotificationBundle\Manager\NotificationManager`
- Remove class `Pim\Bundle\EnrichBundle\Form\Subscriber\AddAttributeAsLabelSubscriber`
- Remove class `Pim\Bundle\EnrichBundle\Form\Subscriber\AddAttributeRequirementsSubscriber`
- Remove class `Pim\Bundle\EnrichBundle\Form\Subscriber\DisableFamilyFieldsSubscriber`
- Remove interface `Pim\Bundle\UIBundle\Entity\Repository\OptionRepositoryInterface`
- Move all classes in `Pim\Component\Catalog\Denormalizer\Structured\` to `Pim\Component\Catalog\Denormalizer\Standard\`
- Move all classes in `Pim\Component\ReferenceData\Denormalizer\Structured\` to `Pim\Component\ReferenceData\Denormalizer\Standard\`
- Move `Akeneo\Component\Batch\Normalizer\Structured\JobInstanceNormalizer` to `Akeneo\Component\Batch\Normalizer\Standard\JobInstanceNormalizer`
- Move `Pim\Component\Catalog\Normalizer\Structured\AssociationTypeNormalizer` to `Pim\Component\Catalog\Normalizer\Standard\AssociationTypeNormalizer`
- Move `Pim\Component\Catalog\Normalizer\Structured\AttributeGroupNormalizer` to `Pim\Component\Catalog\Normalizer\Standard\AttributeGroupNormalizer`
- Move `Pim\Component\Catalog\Normalizer\Structured\AttributeNormalizer` to `Pim\Component\Catalog\Normalizer\Standard\AttributeNormalizer`
- Move `Pim\Component\Catalog\Normalizer\Structured\AttributeOptionNormalizer` to `Pim\Component\Catalog\Normalizer\Standard\AttributeOptionNormalizer`
- Move `Pim\Component\Catalog\Normalizer\Structured\CategoryNormalizer` to `Pim\Component\Catalog\Normalizer\Standard\CategoryNormalizer`
- Move `Pim\Component\Catalog\Normalizer\Structured\ChannelNormalizer` to `Pim\Component\Catalog\Normalizer\Structured\ChannelNormalizer`.
- Move `Pim\Component\Catalog\Normalizer\Structured\CurrencyNormalizer` to `Pim\Component\Catalog\Normalizer\Standard\CurrencyNormalizer`
- Move `Pim\Component\Catalog\Normalizer\Structured\DateTimeNormalizer` to `Pim\Component\Catalog\Normalizer\Standard\DateTimeNormalizer`
- Move `Pim\Component\Catalog\Normalizer\Structured\FamilyNormalizer` to `Pim\Component\Catalog\Normalizer\Standard\FamilyNormalizer`
- Move `Pim\Component\Catalog\Normalizer\Structured\FileNormalizer` to `Pim\Component\Catalog\Normalizer\Standard\FileNormalizer`
- Move `Pim\Component\Catalog\Normalizer\Structured\GroupNormalizer` to `Pim\Component\Catalog\Normalizer\Standard\ProxyGroupNormalizer`. Remove `Symfony\Component\Serializer\Normalizer\DenormalizerInterface`, `Symfony\Component\Serializer\Normalizer\NormalizerInterface` and `Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer` from the constructor and add `Symfony\Component\Serializer\Normalizer\NormalizerInterface` as first and second parameters.
- Move `Pim\Component\Catalog\Normalizer\Structured\GroupTypeNormalizer` to `Pim\Component\Catalog\Normalizer\Standard\GroupTypeNormalizer`
- Move `Pim\Component\Catalog\Normalizer\Structured\LocaleNormalizer` to `Pim\Component\Catalog\Normalizer\Standard\LocaleNormalizer`
- Move `Pim\Component\Catalog\Normalizer\Structured\MetricNormalizer` to `Pim\Component\Catalog\Normalizer\Standard\Product\MetricNormalizer`
- Move `Pim\Component\Catalog\Normalizer\Structured\ProductAssociationsNormalizer` to `Pim\Component\Catalog\Normalizer\Standard\Product\AssociationsNormalizer`
- Move `Pim\Component\Catalog\Normalizer\Structured\ProductNormalizer` to `Pim\Component\Catalog\Normalizer\Standard\ProductNormalizer`
- Move `Pim\Component\Catalog\Normalizer\Structured\ProductPriceNormalizer` to `Pim\Component\Catalog\Normalizer\Standard\Product\PriceNormalizer`
- Move `Pim\Component\Catalog\Normalizer\Structured\ProductPropertiesNormalizer` to `Pim\Component\Catalog\Normalizer\Standard\Product\PropertiesNormalizer`
- Move `Pim\Component\Catalog\Normalizer\Structured\ProductValueNormalizer` to `Pim\Component\Catalog\Normalizer\Standard\Product\ProductValueNormalizer`
- Move `Pim\Component\Catalog\Normalizer\Structured\ProductValuesNormalizer` to `Pim\Component\Catalog\Normalizer\Standard\Product\ProductValuesNormalizer`
- Move `Pim\Component\Catalog\Normalizer\Structured\TranslationNormalizer` to `Pim\Component\Catalog\Normalizer\Standard\TranslationNormalizer`
- Move `Pim\Bundle\CommentBundle\Normalizer\Structured\CommentNormalizer` to `Pim\Bundle\CommentBundle\Normalizer\Standard\CommentNormalizer` and remove `Akeneo\Component\Localization\Presenter\PresenterInterface` and `Pim\Bundle\EnrichBundle\Resolver\LocaleResolver` from constructor.
- Move `Pim\Bundle\UserBundle\Entity\Repository\GroupRepository` to `Pim\Bundle\UserBundle\Doctrine\ORM\Repository\GroupRepository`
- Move `Pim\Bundle\UserBundle\Entity\Repository\RoleRepository` to `Pim\Bundle\UserBundle\Doctrine\ORM\Repository\RoleRepository`
- Move `Pim\Bundle\UserBundle\Entity\Repository\UserRepository` to `Pim\Bundle\UserBundle\Doctrine\ORM\Repository\UserRepository`
- Move `Pim\Bundle\UserBundle\Entity\Repository\UserRepositoryInterface` to `Pim\Bundle\Repository\UserRepositoryInterface`
- `Pim\Component\Catalog\Model\ChannelInterface` implements `Akeneo\Component\Localization\Model\TranslatableInterface`
- Update classes and services to use the interface `Pim\Component\User\Model\GroupInterface` in place of `Oro\Bundle\UserBundle\Entity\Group`

### Constructors

- Change the constructor of `Pim\Component\Catalog\Updater\ChannelUpdater` to add `Pim\Component\Catalog\Repositor\AttributeRepositoryInterface` and add `Akeneo\Bundle\MeasureBundle\Manager\MeasureManager`
- Change the constructor of `Pim\Component\Catalog\Denormalizer\Standard\ProductValueDenormalizer` to add `Pim\Component\Catalog\Factory\ProductValueFactory`
- Change the constructor of `Pim\Component\Catalog\Builder\ProductBuilder` to add `Pim\Component\Catalog\Factory\ProductValueFactory`
- Change the constructor of `Pim\Bundle\FilterBundle\Filter\Product\InGroupFilter` to add `Pim\Bundle\CatalogBundle\Doctrine\Common\Filter\ObjectCodeResolver`
- Change the constructor of `Pim\Component\Connector\Writer\File\Yaml\Writer` to add `Pim\Component\Connector\ArrayConverter\ArrayConverterInterface`
- Change the constructor of `Pim\Bundle\VersioningBundle\Normalizer\Flat\AssociationTypeNormalizer` to add `Symfony\Component\Serializer\Normalizer\NormalizerInterface`
- Change the constructor of `Pim\Bundle\VersioningBundle\Normalizer\Flat\AttributeGroupNormalizer` to add `Symfony\Component\Serializer\Normalizer\NormalizerInterface`
- Change the constructor of `Pim\Bundle\VersioningBundle\Normalizer\Flat\Attribute` to add `Symfony\Component\Serializer\Normalizer\NormalizerInterface`
- Change the constructor of `Pim\Bundle\VersioningBundle\Normalizer\Flat\CategoryNormalizer` to add `Symfony\Component\Serializer\Normalizer\NormalizerInterface`
- Change the constructor of `Pim\Bundle\VersioningBundle\Normalizer\Flat\ChannelNormalizer` to add `Symfony\Component\Serializer\Normalizer\NormalizerInterface`
- Change the constructor of `Pim\Bundle\VersioningBundle\Normalizer\Flat\FamilyNormalizer` to add `Symfony\Component\Serializer\Normalizer\NormalizerInterface`
- Change the constructor of `Pim\Bundle\VersioningBundle\Normalizer\Flat\FileNormalizer` to remove `Pim\Component\Connector\Writer\File\FileExporterPathGeneratorInterface`
- Change the constructor of `Pim\Bundle\VersioningBundle\Normalizer\Flat\GroupNormalizer` to add `Symfony\Component\Serializer\Normalizer\NormalizerInterface`
- Change the constructor of `Pim\Bundle\VersioningBundle\Normalizer\Flat\LocaleNormalizer` to add `Symfony\Component\Serializer\Normalizer\NormalizerInterface`
- Change the constructor of `Pim\Bundle\VersioningBundle\Normalizer\Flat\ProductValueNormalizer` to remove `Pim\Component\Catalog\Localization\Localizer\LocalizerRegistryInterface`
- Change the constructor of `Pim\Bundle\DashboardBundle\Widget\CompletenessWidget` to add the FQCN `Pim\Bundle\CatalogBundle\Entity\ChannelTranslation` (string)
- Change the constructor of `Pim\Bundle\EnrichBundle\Form\Type\ChannelType` to add `Pim\Bundle\UserBundle\Context\UserContext`
- Change the constructor of `Pim\Component\Connector\ArrayConverter\FlatToStandard\ProductAssociation` to remove `Pim\Component\Connector\ArrayConverter\FlatToStandard\Product\AttributeColumnsResolver`
- Change the constructor of `Pim\Component\Connector\ArrayConverter\FlatToStandard\Product`. Add `Pim\Component\Catalog\Repository\AttributeRepositoryInterface` and `Pim\Component\Connector\ArrayConverter\ArrayConverterInterface`. Remove `Pim\Component\Connector\ArrayConverter\FlatToStandard\Product\ValueConverter\ValueConverterRegistryInterface` and `Pim\Component\Connector\ArrayConverter\FlatToStandard\Product\AttributeColumnInfoExtractor`
- Change the constructor of `Pim\Bundle\DataGridBundle\Controller\DatagridViewController` to keep `Symfony\Bundle\FrameworkBundle\Templating\EngineInterface` as the only argument
- Change the constructor of `Pim\Bundle\DataGridBundle\Controller\Rest\DatagridViewController`add `Akeneo\Component\StorageUtils\Updater\ObjectUpdaterInterface` and `Akeneo\Component\StorageUtils\Factory\SimpleFactoryInterface`
- Change the constructor of `Pim\Bundle\EnrichBundle\Controller\Rest\CategoryController` to add `Symfony\Component\Serializer\Normalizer\NormalizerInterface`
- Change the constructor of `Pim\Bundle\EnrichBundle\Controller\Rest\ProductCommentController`. Add `Akeneo\Component\Localization\Presenter\PresenterInterface` and `Pim\Bundle\EnrichBundle\Resolver\LocaleResolver`.
- Change the constructor of `Pim\Bundle\EnrichBundle\Controller\Rest\ProductController` to add `Pim\Component\Enrich\Converter\ConverterInterface`
- Change the constructor of `Pim\Bundle\EnrichBundle\Controller\Rest\VariantGroupController` to add `Pim\Component\Enrich\Converter\ConverterInterface`
- Change the constructor of `Pim\Bundle\EnrichBundle\MassEditAction\Operation\EditCommonAttributes` to remove the tenth argument `tmpStorageDir` and add `Pim\Component\Enrich\Converter\ConverterInterface`
- Change the constructor of `Pim\Bundle\EnrichBundle\Normalizer\GroupNormalizer` to add `Pim\Component\Enrich\Converter\ConverterInterface`
- Change the constructor of `Pim\Bundle\EnrichBundle\Normalizer\ProductNormalizer` to add `Pim\Component\Enrich\Converter\ConverterInterface`
- Change the constructor of `Pim\Bundle\EnrichBundle\Normalizer\AssociationTypeNormalizer` to add `versionManager` and `versionNormalizer`
- Change the constructor of `Pim\Bundle\EnrichBundle\Controller\Rest\AssociationTypeController` to add `remover`, `updater`, `saver`, `validator` and `userContext`
- Change the constructor of `Pim\Bundle\ImportExportBundle\Controller\JobProfileController` to remove `Akeneo\Bundle\BatchBundle\Launcher\JobLauncherInterface`, `Symfony\Component\HttpFoundation\Request`, `Symfony\Component\EventDispatcher\EventDispatcherInterface`, `Symfony\Component\Validator\Validator\ValidatorInterface`, `Pim\Bundle\ImportExportBundle\JobTemplate\JobTemplateProviderInterface`, `Pim\Bundle\ImportExportBundle\Entity\Repository\JobInstanceRepository`, `Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface`, `Akeneo\Component\Batch\Job\JobParametersValidator`
- Change the constructor of `Pim\Component\Catalog\Updater\AssociationTypeUpdater` to remove `Akeneo\Component\StorageUtils\Repository\IdentifiableObjectRepositoryInterface`
- Change the constructor of `Pim\Bundle\DashboardBundle\Widget\LinksWidget` to add `Oro\Bundle\SecurityBundle\SecurityFacade` and array parameters
- Change the constructor of `Pim\Bundle\DashboardBundle\Widget\CompletenessWidget` to add `Pim\Bundle\CatalogBundle\Filter\ObjectFilterInterface`
- Change the constructor of `Pim\Bundle\DashboardBundle\Widget\LastOperationsWidget` to add `Oro\Bundle\SecurityBundle\SecurityFacade` and array parameters
- Change the constructor of `Pim\Bundle\EnrichBundle\Controller\Rest\ChannelController` to add `Pim\Component\Catalog\Updater\ChannelUpdater`, `Akeneo\Component\StorageUtils\Saver\SaverInterface`, `Akeneo\Component\StorageUtils\Remover\RemoverInterface`, `Akeneo\Component\StorageUtils\Factory\SimpleFactoryInterface`, `Symfony\Component\Validator\Validator\ValidatorInterface`
- Change the constructor of `Pim\Bundle\EnrichBundle\Controller\ChannelController` to remove all dependencies
- Change the constructor of `Pim\Bundle\EnrichBundle\Normalizer\ChannelNormalizer` to add `Pim\Bundle\VersioningBundle\Manager\VersionManager` and `Symfony\Component\Serializer\Normalizer\NormalizerInterface`
- Change the constructor of `Pim\Bundle\DataGridBundle\Manager\DatagridViewManager` to remove `Akeneo\Component\StorageUtils\Saver\SaverInterface` and `Akeneo\Component\StorageUtils\Remover\RemoverInterface`
- Change the constructor of `Pim\Bundle\EnrichBundle\Manager\SequentialEditManager` to remove `Akeneo\Component\StorageUtils\Saver\SaverInterface`
- Change the constructor of `Pim\Bundle\EnrichBundle\Controller\SequentialEditController` to add `Akeneo\Component\StorageUtils\Saver\SaverInterface`
- Update the constructor of `Pim\Bundle\UIBundle\Form\Transformer\AjaxEntityTransformer` first parameter to `Pim\Bundle\CatalogBundle\Doctrine\ORM\Repository\AttributeOptionRepository`
- Change the constructor of `Pim\Bundle\EnrichBundle\Controller\FamilyController` to remove `formFactory`, `templating`, `translator`, `doctrine`, `channelRepository`, `attributeClass`, `familySaver`, `familyRemover`, `familyClass`, `attributeRepo`, `familyRepository`, `validator`
- Change the constructor of `Pim\Bundle\EnrichBundle\Controller\Rest\FamilyController` to add `updater`, `saver`, `remover`, `validator`, `securityFacade`
- Change the constructor of `Pim\Bundle\EnrichBundle\Form\Type\FamilyType` to remove `requireSubscriber`, `attributeClass`, `fieldSubscriber`, `labelSubscriber`
- Change the constructor of `Pim\Bundle\EnrichBundle\Controller\Rest\AttributeGroupController` to add `attributeGroupSearchableRepository`

### Methods

- Remove `createDatagridQueryBuilder` method from `Pim\Component\Catalog\Repository\CurrencyRepositoryInterface`
- Remove `createDatagridQueryBuilder` method from `Pim\Component\Catalog\Repository\LocaleInterface`
- Remove `createDatagridQueryBuilder` method from `Pim\Component\Catalog\Repository\AssociationTypeRepositoryInterface`
- Remove `createDatagridQueryBuilder` method from `Pim\Component\Catalog\Repository\AttributeRepositoryInterface`
- Remove `createDatagridQueryBuilder` method from `Pim\Component\Catalog\Repository\ChannelRepositoryInterface`
- Remove `createDatagridQueryBuilder` method from `Pim\Component\Catalog\Repository\FamilyRepositoryInterface`
- Remove `createDatagridQueryBuilder` method from `Pim\Component\Catalog\Repository\GroupRepositoryInterface`
- Remove `createDatagridQueryBuilder` method from `Pim\Component\Catalog\Repository\GroupTypeRepositoryInterface`
- Remove methods `listColumnsAction` and  `removeAction` of the `Pim\Bundle\DataGridBundle\Controller\DatagridViewController`
- Remove unused `findCommonAttributeIds` method from `Pim\Component\Catalog\Repository\ProductMassActionRepositoryInterface`
- Remove deprecated `findAllWithAttribute` method from `Pim\Component\Catalog\Repository\ProductRepositoryInterface`
- Remove deprecated `findAllWithAttributeOption` method from `Pim\Component\Catalog\Repository\ProductRepositoryInterface`
- Remove deprecated method `getDeletedLocaleIdsForChannel` from `Pim\Bundle\CatalogBundle\Doctrine\ORM\Repository\ChannelRepository` and `Pim\Component\Catalog\Repository\ChannelRepositoryInterface`
- Remove deprecated method `removeAttributeFromProduct` from `Pim\Component\Catalog\Builder\ProductBuilder` and `Pim\Component\Catalog\Builder\ProductBuilderInterface`
- Remove deprecated methods `addAttribute`, `removeAttribute`, `getAttributes`, `setAttributes` and `getAttributeIds` from `Pim\Bundle\CatalogBundle\Entity\Group` and `Pim\Component\Catalog\Model\GroupInterface`
- Change the constructor of `Pim\Component\Catalog\Updater\ProductUpdater` to add an array parameter
- Add a new argument `$localeCode` (string) in `Pim\Component\Catalog\Repository\ChannelRepositoryInterface::getLabelsIndexedByCode()`
- Add a new argument `$localeCode` (string) in `Pim\Component\Catalog\Repository\CompletenessRepositoryInterface::getProductsCountPerChannels()` and `Pim\Component\Catalog\CompletenessRepositoryInterface::getCompleteProductsCountPerChannels()`
- Add method `getAllChildrenCodes` to `Akeneo\Component\Classification\Repository\CategoryRepositoryInterface`
- Add method `findDatagridViewBySearch` to `Pim\Bundle\DataGridBundle\Repository\DatagridViewRepositoryInterface`
- Remove `removeAction` method of `Pim\Bundle\EnrichBundle\Controller\ChannelController`
- Change `Pim\Bundle\EnrichBundle\Controller\AssociationTypeController` to remove `removeAction` and change `editAction`
- Change method `indexAction` of `Pim\Bundle\EnrichBundle\Controller\Rest\LocaleController` to return all locales by default and only activated if `activated` parameter `true`
- Rename method `findDatagridViewByUserAndAlias` to `findDatagridViewByAlias` and removed the UserInterface parameter

### Exceptions

- Change exception `\InvalidArgumentException` by `Akeneo\Component\StorageUtils\Exception\PropertyException` thrown by `Akeneo\Component\StorageUtils\Updater\ObjectUpdaterInterface:update()`
- Change exception `Pim\Component\Catalog\Exception\InvalidArgumentException` and `\RuntimeException` by `Akeneo\Component\StorageUtils\Exception\PropertyException` thrown by `Pim\Component\Catalog\Updater\Copier\AttributeCopierInterface:copyAttributeData()`
- Change exception `Pim\Component\Catalog\Exception\InvalidArgumentException` and `\RuntimeException` by `Akeneo\Component\StorageUtils\Exception\PropertyException` thrown by `Pim\Component\Catalog\Updater\Copier\FieldCopierInterface:copyFieldData()`
- Replace arguments `$action, $type` by `$className` (string) on `Pim\Component\Catalog\Exception\InvalidArgumentException`
- Add exception `Akeneo\Component\StorageUtils\Exception\PropertyException` thrown by `Pim\Component\Catalog\Updater\Adder\AttributeAdderInterface:addAttributeData()`
- Add exception `Akeneo\Component\StorageUtils\Exception\PropertyException` thrown by `Pim\Component\Catalog\Updater\Adder\FieldAdderInterface:addFieldData()`
- Add exception `Akeneo\Component\StorageUtils\Exception\PropertyException` thrown by `Pim\Component\Catalog\Updater\Remover\AttributeRemoverInterface:removeAttributeData()`
- Add exception `Akeneo\Component\StorageUtils\Exception\PropertyException` thrown by `Pim\Component\Catalog\Updater\Remover\FieldRemoverInterface:removeFieldData()`
- Add exception `Akeneo\Component\StorageUtils\Exception\PropertyException` thrown by `Pim\Component\Catalog\Updater\Setter\AttributeSetterInterface:setAttributeData()`
- Add exception `Akeneo\Component\StorageUtils\Exception\PropertyException` thrown by `Pim\Component\Catalog\Updater\Setter\FieldSetterInterface:setFieldData()`

### Configuration

- Remove `wsse_secured` firewall in security.yml
