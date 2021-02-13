import {ADD_PRODUCTS} from "../actions/actionTypes";

const initialState = {
    products: [],
}

const productReducer = (state = initialState, {type, payload}) => {
    switch (type) {
        case ADD_PRODUCTS:
            return {
                ...state,
                products: payload
            }
        default:
            return state;
    }
}

export default productReducer;
