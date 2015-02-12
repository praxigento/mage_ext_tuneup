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
 * Created by JetBrains PhpStorm.
 * User: Alex Gusev <flancer64@gmail.com>
 */
class Praxigento_TuneUp_Config
{

    /**
     * Enable/disable Product Comparison component on frontend.
     * @static
     * @return bool
     */
    public static function cfgFrontendProductComparisonDisabled()
    {
        return filter_var(Mage::getStoreConfig('prxgt_tup/frontend/product_comparison_disabled'), FILTER_VALIDATE_BOOLEAN);
    }

    public static function cfgFrontendNavigationLinksDisabled($store = null)
    {
        $entries = Mage::getStoreConfig('prxgt_tup/frontend/navigation_links_disabled', $store);
        $result  = explode(',', $entries);
        if ((count($result) == 1) && ($result[0] == '')) {
            /** setup default value in case of there is no data in config */
            $result = array();
        }
        return $result;
    }

    /**
     * Returns default helper for the module.
     * @return Praxigento_TuneUp_Helper_Data
     */
    public static function helper()
    {
        return Mage::helper('prxgt_tup_helper');
    }
}
