<?php
/**
 * Copyright (c) 2013, Praxigento
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification, are permitted provided that the
 * following conditions are met:
 *  - Redistributions of source code must retain the above copyright notice, this list of conditions and the following
 *      disclaimer.
 *  - Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the
 *      following disclaimer in the documentation and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES,
 * INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY,
 * WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */
/**
 * Customer account navigation links extractor (from layout updates).
 */
class Praxigento_TuneUp_Model_Own_Source_NavigationLinks
{
    /** @var array|null cache the source */
    protected $_cached = null;

    /**
     * Load frontend layout and extract navigation links.
     * @return array|null
     */
    public function toOptionArray()
    {
        if (is_null($this->_cached)) {
            /** @var $updateFront Mage_Core_Model_Layout_Update */
            $updateFront = Mage::getModel('core/layout')->getUpdate();
            $layoutFront = $updateFront->getFileLayoutUpdatesXml(
                Mage_Core_Model_Design_Package::DEFAULT_AREA,
                Mage_Core_Model_Design_Package::DEFAULT_PACKAGE,
                Mage_Core_Model_Design_Package::DEFAULT_THEME);
            $links       = $layoutFront->xpath("//reference[@name='customer_account_navigation']/action[@method='addLink']");
            if (is_array($links)) {
                /** @var $one Mage_Core_Model_Layout_Element */
                foreach ($links as $one) {
                    $linkLabel                 = (string)$one->label;
                    $linkName                  = (string)$one->name;
                    $this->_cached[$linkLabel] = array(
                        'label' => $linkLabel,
                        'value' => $linkName
                    );
                }
            }
            /** add extra entry to enable all links */
            $allEnabled['label'] = Praxigento_TuneUp_Config::helper()->__('-- All Enabled --');
            $allEnabled['value'] = '-1';
            $this->_cached[]     = $allEnabled;
            /** sort links by label */
            asort($this->_cached);
        }
        return $this->_cached;
    }

}

