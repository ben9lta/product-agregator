import React from 'react';
import categoryService from "../../api/services/categoryService";
import storeService from "../../api/services/storeService";
import {categoryActions} from "./categoryActions";
import {storeActions} from "./storeActions";

export default {
    init: function () {
        return dispatch => {
            Promise.all([
                categoryService.fetch().then(categories => dispatch(categoryActions.setCategories(categories))),
                storeService.fetch().then(stores => dispatch(storeActions.setStores(stores))),
            ])
        }

    }
}
