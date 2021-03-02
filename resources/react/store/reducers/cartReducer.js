import {SET_CART, ADD_PRODUCT_TO_CART} from "../actions/actionTypes";

const initialState = {
    cart: {
        total: 0,
        products: [],
    },
}

const cartReducer = (state = initialState, {type, payload}) => {
    switch (type) {
        case SET_CART:
            return {
                ...state,
                cart: payload,
            }
        case ADD_PRODUCT_TO_CART:
            return {
                ...state,
                cart: {...state.cart, products: payload},
            }
        default:
            return state;
    }
}

export default cartReducer;
