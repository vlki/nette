<?php

/*use Nette\Environment;*/
/*use Nette\Application\AppForm;*/
/*use Nette\Forms\Form;*/
/*use Nette\Security\AuthenticationException;*/

require_once dirname(__FILE__) . '/BasePresenter.php';


class AuthPresenter extends BasePresenter
{
	/** @persistent */
	public $backlink = '';



	public static function getPersistentParams()
	{
		return array('backlink');
	}



	/********************* component factories *********************/



	/**
	 * Login form component factory.
	 * @return mixed
	 */
	protected function createComponentLoginForm()
	{
		$form = new AppForm;
		$form->addText('username', 'Username:')
			->addRule(Form::FILLED, 'Please provide an username.');

		$form->addPassword('password', 'Password:')
			->addRule(Form::FILLED, 'Please provide a password.');

		$form->addSubmit('login', 'Login');

		$form->addProtection('Please submit this form again (security token has expired).');

		/**/$form->onSubmit[] = array($this, 'loginFormSubmitted');/**/
		/* PHP 5.3
		$that = $this;
		$form->onSubmit[] = function($form) use ($that) {
			try {
				$user = Environment::getUser();
				$user->authenticate($form['username']->getValue(), $form['password']->getValue());
				$that->getApplication()->restoreRequest($that->backlink);
				$that->redirect('Dashboard:');

			} catch (AuthenticationException $e) {
				$form->addError($e->getMessage());
			}
		};*/
		return $form;
	}


	/**/
	public function loginFormSubmitted($form)
	{
		try {
			$user = Environment::getUser();
			$user->authenticate($form['username']->getValue(), $form['password']->getValue());
			$this->getApplication()->restoreRequest($this->backlink);
			$this->redirect('Dashboard:');

		} catch (AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}
	/**/

}
