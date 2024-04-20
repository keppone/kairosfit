<?php

namespace App\Entity;

class PartnerSearchData
{
    /**
     * @var string|null
     */
    private $searchWord;

    /**
     * @var bool|null
     */
    private $partnerActive;

   /**
     * @var bool|null
     */
    private $partnerInactive; 

    public function getSearchWord():?string
    {
      return $this->searchWord;  
    }

    public function setSearchWord(string $searchWord):PartnerSearchData
    {
      $this->searchWord=$searchWord;
      return $this; 

    }
    public function getPartnerActive():?bool
    {
      return $this->partnerActive;  

    }

    public function setPartnerActive(bool $partnerActive):PartnerSearchData
    {
      $this->partnerActive=$partnerActive;
      return $this;  
    }
    
    public function getPartnerInactive():?bool
    {
      return $this->partnerInactive;  

    }

    public function setPartnerInactive(bool $partnerInactive):PartnerSearchData
    {
      $this->partnerInactive=$partnerInactive;
      return $this;  
    }
}