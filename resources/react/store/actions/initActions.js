import React from 'react';
import categoryService from "../../api/services/categoryService";
import storeService from "../../api/services/storeService";
import productService from "../../api/services/productService";

export default {
    init: function () {
        return dispatch => {
            Promise.all([
                categoryService.fetchAndSave(dispatch),
                storeService.fetchAndSave(dispatch),
                productService.fetchAndSave(dispatch),
            ])
        }

    }
}
