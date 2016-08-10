<?php if(!defined('ABSPATH')) die('Fatal Error');

class Investophp{

    public $email = null;
    protected $pass = null;
    protected $browser;
    protected $page;
    public $defaults = [
        'domain' => 'http://www.investopedia.com',
        'page' => [
            'login' => '/accounts/login.aspx?returnurl=http://www.investopedia.com/simulator/',
            'portfolio' => '/simulator/portfolio/'
        ],
        'id' => [
            'acct_val'  => "ctl00_MainPlaceHolder_currencyFilter_ctrlPortfolioDetails_PortfolioSummary_lblAccountValue",
            'buying_power' => "ctl00_MainPlaceHolder_currencyFilter_ctrlPortfolioDetails_PortfolioSummary_lblBuyingPower",
            'cash'  => "ctl00_MainPlaceHolder_currencyFilter_ctrlPortfolioDetails_PortfolioSummary_lblCash",
            'return'  => "ctl00_MainPlaceHolder_currencyFilter_ctrlPortfolioDetails_PortfolioSummary_lblAnnualReturn",
        ]
    ];

    public function __CONSTRUCT($email,$pass,$config = []){

        // Initialize Variables
        $this->email = $email;
        $this->pass = $pass;
        $driver = new \Behat\Mink\Driver\GoutteDriver();
        $this->browser = new \Behat\Mink\Session($driver);
        $this->browser->start();

        // Login the account
        $this->login();

        return self;
    }

    /*
    * Logs a user into Investopedia's trading simulator,
    * given a *username* and *password*.
    */
    protected function login(){
        $this->browser->visit($this->defaults['domain'] . $this->defaults['page']['login']);
        $this->page = $this->browser->getPage();
        $this->page->findById('edit-email')->setValue($this->email);
        $this->page->findById('edit-password')->setValue($this->pass);
        $this->page->findById('account-api-form')->submit();
    }

    /*
    * Returns a Status object containing account value,
    * buying power, cash on hand, and annual return.
    * Annual return is a percentage.
    */
    public function getPortfolioStatus(){
        $this->browser->visit($this->defaults['domain'] . $this->defaults['page']['portfolio']);
        $this->page = $this->browser->getPage();
        $acct_val = $this->page->findById($this->defaults['id']['acct_val'])->getText();
        $buying_power = $this->page->findById($this->defaults['id']['buying_power'])->getText();
        $cash = $this->page->findById($this->defaults['id']['cash'])->getText();
        $return = $this->page->findById($this->defaults['id']['return'])->getText();

        return [
            'acct_val' => floatval(preg_replace("/[^0-9.]/", "", $acct_val)) ,
            'buying_power' => floatval(preg_replace("/[^0-9.]/", "", $buying_power)) ,
            'cash' => floatval(preg_replace("/[^0-9.]/", "", $cash)) ,
            'return' => floatval(preg_replace("/[^0-9.]/", "", $return)) ,
        ];
    }
}
