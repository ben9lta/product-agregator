import {ADD_PRODUCTS} from "./actionTypes";

export const productActions = {
    setProducts: (products) => ({
        type: ADD_PRODUCTS,
        payload: products
    }),
}
