import {SET_CART, ADD_PRODUCT_TO_CART} from "./actionTypes";

export const cartActions = {
    setCart: (cart) => ({
        type: SET_CART,
        payload: cart
    }),
    addToCart: (product_id) => ({
        type: ADD_PRODUCT_TO_CART,
        payload: product_id
    }),
}

