<?php

/**
 * PluginsbEcomProduct form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginsbEcomProductForm extends BasesbEcomProductForm
{
	public function setup()
	{	
		parent::setup();
		$this->getWidgetSchema()->setNameFormat('sb-ecom-product-%s');
		
		// get the current user
		$user = sfContext::getInstance()->getUser();
		
		// set the author
		$this->setWidget('author_id', new sfWidgetFormInputHidden(array(), array()));
		$this->setDefault('author_id', $user->getGuardUser()->getId());
		
		// Main Details
		$this->setWidget('title', new sfWidgetFormInputText(array('label' => 'Product title<span class="required">*</span>'), array('class' => 'large')));
		$this->setValidator('title', new sfValidatorString(array('required' => true), array('required' => 'Please enter the product title')));
		
		$this->setWidget('slug', new sfWidgetFormInputText(array('label' => 'URL Segment<span class="required">*</span>'), array('class' => 'medium')));
		$this->setValidator('slug', new sfValidatorString(array('required' => true), array('required' => 'Please enter the product url segment')));
		
		$this->setWidget('long_title', new sfWidgetFormInputText(array('label' => 'Long title'), array('class' => 'large')));
		$this->setValidator('long_title', new sfValidatorString(array('required' => false), array()));
		
		$this->setWidget('reference', new sfWidgetFormInputText(array('label' => 'Reference ID<span class="required">*</span>'), array('class' => 'small')));
		$this->setValidator('reference', new sfValidatorString(array('required' => true), array('required' => 'Please enter the unique reference ID for this product')));
		
		$this->setWidget('brand_id', new sfWidgetFormDoctrineChoice(array('model' => 'sbEcomBrand', 'add_empty' => 'No attached brand')));
		$this->setValidator('brand_id', new sfValidatorDoctrineChoice(array('model' => 'sbEcomBrand', 'required' => false)));
		
		$this->setWidget('description', new aWidgetFormRichTextarea(array('tool' => 'sbEcom', 'height' => 182), array()));
		$this->setValidator('description', new sfValidatorHtml(array('required' => false), array()));
		
		// meta information
		$this->setWidget('meta_title', new sfWidgetFormInputText(array('label' => 'Meta title<span class="required">*</span>'), array('class' => 'large')));
		$this->setValidator('meta_title', new sfValidatorString(array(), array('required' => 'Please fill in the product meta title')));
		
		$this->setWidget('meta_description', new sfWidgetFormInputText(array('label' => 'Meta description<span class="required">*</span>'), array('class' => 'large')));
		$this->setValidator('meta_description', new sfValidatorString(array(), array('required' => 'Please fill in the product meta description')));
		
		$this->setWidget('meta_keywords', new sfWidgetFormInputText(array('label' => 'Meta keywords<span class="required">*</span>'), array('class' => 'large')));
		$this->setValidator('meta_keywords', new sfValidatorString(array(), array('required' => 'Please fill in the product meta keywords')));
		
		// Costing details
		$this->setWidget('cost', new sfWidgetFormInputText(array(), array('class' => 'small')));
		$this->setValidator('cost', new sfValidatorNumber(array('min' => 0, 'required' => false), array('min' => 'Please enter a value greater than 0')));
		
		$this->setWidget('tax', new sfWidgetFormInputText(array(), array('class' => 'small')));
		$this->setValidator('tax', new sfValidatorNumber(array('min' => 0, 'required' => false), array('min' => 'Please enter a value greater than 0')));
		
		// Postage details
		$this->setWidget('postage_weight', new sfWidgetFormInputText(array(), array('class' => 'small')));
		$this->setValidator('postage_weight', new sfValidatorNumber(array('min' => 0, 'required' => false), array('min' => 'Please enter a value greater than 0')));
		
		$this->setWidget('postage_fixed_cost', new sfWidgetFormInputText(array(), array('class' => 'small')));
		$this->setValidator('postage_fixed_cost', new sfValidatorNumber(array('min' => 0, 'required' => false), array('min' => 'Please enter a value greater than 0')));
		
		// Product Descriptions
		/*if(!$this->isNew())
		{
			$product = $this->getObject();
			$j = count($product->Descriptions);

			// embed the Descriptions Sub Form
			$this->embedRelation('Descriptions');
			
			// add another
			$subForm = new sfForm();
			
			for($i = $j; $i < sfConfig::get('app_sbEcom_num_product_descriptions', 10); $i++)
			{
				$productDescription = new sbEcomProductDescription();
				$productDescription->Product = $product;
				$newForm = new sbEcomProductDescriptionForm($productDescription);
				$newForm->setDefault('author_id', $user->getGuardUser()->getId());
				$subForm->embedForm($i, $newForm);
			}
			
			$this->embedForm('newDescriptions', $subForm);
		}
		 */
		
		// Tags
		$options['default'] = implode(', ', $this->getObject()->getTags());
		if (sfConfig::get('app_a_all_tags', true))
		{
			$options['all-tags'] = PluginTagTable::getAllTagNameWithCount();
		}
		else
		{
			$options['typeahead-url'] = url_for('taggableComplete/complete');
		}
		
		$options['popular-tags'] = PluginTagTable::getPopulars(null, array(), false);
		$this->setWidget('tags', new pkWidgetFormJQueryTaggable($options, array('class' => 'tags-input')));
		$this->setValidator('tags', new sfValidatorString(array('required' => false)));
		
		// post update validations
		$this->validatorSchema->setPostValidator(
			new sfValidatorAnd(array(
				new sfValidatorDoctrineUnique(array('model' => $this->getModelName(), 'column' => 'title'), array('invalid' => 'Please choose a unique title')),
				new sfValidatorDoctrineUnique(array('model' => $this->getModelName(), 'column' => 'slug'), array('invalid' => 'Please choose a unique url segment'))
			))
		);
		
		unset($this['created_at'], $this['updated_at']);
	}
	
	/**
   * Override the saving of embedded forms to not include empty forms.
   *
   * @param mixed $con   An optional connection object
   * @param array $forms An array of forms
   */
  public function saveEmbeddedForms($con = null, $forms = null)
  {
		if(null === $forms)
		{
			// don't save empty new form
			$newForms = $this->getValue('newDescriptions');
			$forms        = $this->embeddedForms;

			foreach($this->embeddedForms['newDescriptions'] as $name => $form)
			{
				if(isset($newForms[$name]['title']) and empty($newForms[$name]['title']))
				{
					unset($forms['newDescriptions'][$name]);
				}
			}
		}

		return parent::saveEmbeddedForms($con, $forms);
  }
}
