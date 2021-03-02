import React from 'react';
import categoryService from "../../api/services/categoryService";
import storeService from "../../api/services/storeService";
import cartService from "../../api/services/cartService";
import {categoryActions} from "./categoryActions";
import {storeActions} from "./storeActions";
import {cartActions} from "./cartActions";

export default {
    init: function () {
        return dispatch => {
            Promise.all([
                categoryService.fetch().then(categories => dispatch(categoryActions.setCategories(categories))),
                storeService.fetch().then(stores => dispatch(storeActions.setStores(stores))),
                cartService.createCart().then(cart => dispatch(cartActions.setCart(cart.data.data))),
            ])
        }

    }
}
