/*
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */

define(
    [
        'Magestore_Webpos/js/model/resource-model/indexed-db/catalog/product-indexer',
        'Magestore_Webpos/js/model/resource-model/indexed-db/abstract'
    ],
    function (indexer , Abstract) {
        "use strict";
        return Abstract.extend({
            mainTable: 'product',
            keyPath: 'id',
            indexes: {
                id: {unique: true},
                sku: {unique: true},
                name: {},
            },
            indexer: indexer,
        });
    }
);