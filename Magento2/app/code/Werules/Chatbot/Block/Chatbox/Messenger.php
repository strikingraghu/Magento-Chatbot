<?php
/**
 * Magento Chatbot Integration
 * Copyright (C) 2017  
 * 
 * This file is part of Werules/Chatbot.
 * 
 * Werules/Chatbot is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace Werules\Chatbot\Block\Chatbox;

class Messenger extends \Magento\Framework\View\Element\Template
{
    protected $_helper;
    protected $_define;
    protected $_chatbotAPI;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Werules\Chatbot\Helper\Data $helperData,
        \Werules\Chatbot\Model\ChatbotAPI $chatbotAPI,
        array $data = array()
    )
    {
        $this->_chatbotAPI = $chatbotAPI;
        $this->_helper = $helperData;
        $this->_define = new \Werules\Chatbot\Helper\Define;
        parent::__construct($context, $data);
    }

    protected function getMessengerInstance()
    {
        $api_token = $this->_helper->getConfigValue('werules_chatbot_messenger/general/api_key');
        $messenger = $this->_chatbotAPI->initMessengerAPI($api_token);
        return $messenger;
    }

    public function getFacebookPageId()
    {
        $messengerInstance = $this->getMessengerInstance();
        $pageDetails = $messengerInstance->getPageDetails();
        $this->_helper->logger($pageDetails);
        die;
    }

    public function getFacebookAppId()
    {
        $appId = $this->getConfigValue('werules_chatbot_general/general/app_id');
        return $appId;
    }

    public function getConfigValue($code)
    {
        return $this->_helper->getConfigValue($code);
    }
}
