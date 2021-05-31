<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2021
 * @package Client
 * @subpackage Html
 */


namespace Aimeos\Client\Html\Cms\Page\Contact;


/**
 * Default implementation for CMS contact form.
 *
 * @package Client
 * @subpackage Html
 */
class Standard
	extends \Aimeos\Client\Html\Common\Client\Factory\Base
	implements \Aimeos\Client\Html\Common\Client\Factory\Iface
{
	/** client/html/cms/page/contact/subparts
	 * List of HTML sub-clients rendered within the cms page contact section
	 *
	 * The output of the frontend is composed of the code generated by the HTML
	 * clients. Each HTML client can consist of serveral (or none) sub-clients
	 * that are responsible for rendering certain sub-parts of the output. The
	 * sub-clients can contain HTML clients themselves and therefore a
	 * hierarchical tree of HTML clients is composed. Each HTML client creates
	 * the output that is placed inside the container of its parent.
	 *
	 * At first, always the HTML code generated by the parent is printed, then
	 * the HTML code of its sub-clients. The order of the HTML sub-clients
	 * determines the order of the output of these sub-clients inside the parent
	 * container. If the configured list of clients is
	 *
	 *  array( "subclient1", "subclient2" )
	 *
	 * you can easily change the order of the output by reordering the subparts:
	 *
	 *  client/html/<clients>/subparts = array( "subclient1", "subclient2" )
	 *
	 * You can also remove one or more parts if they shouldn't be rendered:
	 *
	 *  client/html/<clients>/subparts = array( "subclient1" )
	 *
	 * As the clients only generates structural HTML, the layout defined via CSS
	 * should support adding, removing or reordering content by a fluid like
	 * design.
	 *
	 * @param array List of sub-client names
	 * @since 2021.04
	 * @category Developer
	 */
	private $subPartPath = 'client/html/cms/page/contact/subparts';
	private $subPartNames = [];


	/**
	 * Returns the HTML code for insertion into the body.
	 *
	 * @param string $uid Unique identifier for the output if the content is placed more than once on the same page
	 * @return string HTML code
	 */
	public function getBody( string $uid = '' ) : string
	{
		return '';
	}


	/**
	 * Returns the sub-client given by its name.
	 *
	 * @param string $type Name of the client type
	 * @param string|null $name Name of the sub-client (Default if null)
	 * @return \Aimeos\Client\Html\Iface Sub-client object
	 */
	public function getSubClient( string $type, string $name = null ) : \Aimeos\Client\Html\Iface
	{
		/** client/html/cms/page/contact/decorators/excludes
		 * Excludes decorators added by the "common" option from the cms page contact html client
		 *
		 * Decorators extend the functionality of a class by adding new aspects
		 * (e.g. log what is currently done), executing the methods of the underlying
		 * class only in certain conditions (e.g. only for logged in users) or
		 * modify what is returned to the caller.
		 *
		 * This option allows you to remove a decorator added via
		 * "client/html/common/decorators/default" before they are wrapped
		 * around the html client.
		 *
		 *  client/html/cms/page/contact/decorators/excludes = array( 'decorator1' )
		 *
		 * This would remove the decorator named "decorator1" from the list of
		 * common decorators ("\Aimeos\Client\Html\Common\Decorator\*") added via
		 * "client/html/common/decorators/default" to the html client.
		 *
		 * @param array List of decorator names
		 * @since 2021.04
		 * @category Developer
		 * @see client/html/common/decorators/default
		 * @see client/html/cms/page/contact/decorators/global
		 * @see client/html/cms/page/contact/decorators/local
		 */

		/** client/html/cms/page/contact/decorators/global
		 * Adds a list of globally available decorators only to the cms page contact html client
		 *
		 * Decorators extend the functionality of a class by adding new aspects
		 * (e.g. log what is currently done), executing the methods of the underlying
		 * class only in certain conditions (e.g. only for logged in users) or
		 * modify what is returned to the caller.
		 *
		 * This option allows you to wrap global decorators
		 * ("\Aimeos\Client\Html\Common\Decorator\*") around the html client.
		 *
		 *  client/html/cms/page/contact/decorators/global = array( 'decorator1' )
		 *
		 * This would add the decorator named "decorator1" defined by
		 * "\Aimeos\Client\Html\Common\Decorator\Decorator1" only to the html client.
		 *
		 * @param array List of decorator names
		 * @since 2021.04
		 * @category Developer
		 * @see client/html/common/decorators/default
		 * @see client/html/cms/page/contact/decorators/excludes
		 * @see client/html/cms/page/contact/decorators/local
		 */

		/** client/html/cms/page/contact/decorators/local
		 * Adds a list of local decorators only to the cms page contact html client
		 *
		 * Decorators extend the functionality of a class by adding new aspects
		 * (e.g. log what is currently done), executing the methods of the underlying
		 * class only in certain conditions (e.g. only for logged in users) or
		 * modify what is returned to the caller.
		 *
		 * This option allows you to wrap local decorators
		 * ("\Aimeos\Client\Html\Cms\Decorator\*") around the html client.
		 *
		 *  client/html/cms/page/contact/decorators/local = array( 'decorator2' )
		 *
		 * This would add the decorator named "decorator2" defined by
		 * "\Aimeos\Client\Html\Cms\Decorator\Decorator2" only to the html client.
		 *
		 * @param array List of decorator names
		 * @since 2021.04
		 * @category Developer
		 * @see client/html/common/decorators/default
		 * @see client/html/cms/page/contact/decorators/excludes
		 * @see client/html/cms/page/contact/decorators/global
		 */

		return $this->createSubClient( 'cms/page/contact/' . $type, $name );
	}


	/**
	 * Modifies the cached body content to replace content based on sessions or cookies.
	 *
	 * @param string $content Cached content
	 * @param string $uid Unique identifier for the output if the content is placed more than once on the same page
	 * @return string Modified body content
	 */
	public function modifyBody( string $content, string $uid ) : string
	{
		$content = parent::modifyBody( $content, $uid );

		return $this->replaceSection( $content, $this->getView()->csrf()->formfield(), 'cms.page.contact.csrf' );
	}


	/**
	 * Processes the input, e.g. store given values.
	 *
	 * A view must be available and this method doesn't generate any output
	 * besides setting view variables if necessary.
	 */
	public function process()
	{
		$view = $this->getView();

		$name = $view->param( 'contact/name' );
		$email = $view->param( 'contact/email' );
		$msg = $view->param( 'contact/message' );
		$honeypot = $view->param( 'contact/url' );

		if( !$honeypot && $name && $email && $msg )
		{
			$context = $this->getContext();
			$config = $context->getConfig();

			$toAddr = $config->get( 'resource/email/from-address' );
			$toName = $config->get( 'resource/email/from-name' );

			if( $toAddr )
			{
				$context->mail()->createMessage()
				->addTo( $toAddr, $toName )
				->addFrom( $email, $name )
				->setBody( $msg )
				->send();

				$error = [$context->getI18n()->dt( 'client', 'Message sent successfully' )];
			}
			else
			{
				$error = [$context->getI18n()->dt( 'client', 'No recipient configured' )];
			}

			$view->pageErrorList = array_merge( $view->get( 'pageErrorList', [] ), $error );
		}

		parent::process();
	}


	/**
	 * Returns the list of sub-client names configured for the client.
	 *
	 * @return array List of HTML client names
	 */
	protected function getSubClientNames() : array
	{
		return $this->getContext()->getConfig()->get( $this->subPartPath, $this->subPartNames );
	}
}
