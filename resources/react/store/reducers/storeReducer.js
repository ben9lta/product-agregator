import {ADD_STORES, ADD_SELECTED_STORES} from "../actions/actionTypes";

const initialState = {
    stores: [],
    selectedStores: [],
}

const storeReducer = (state = initialState, {type, payload}) => {
    switch (type) {
        case ADD_STORES:
            return {
                ...state,
                stores: payload,
            }
        case ADD_SELECTED_STORES:
            return {
                ...state,
                selectedStores: payload,
            }
        default:
            return state;
    }
}

export default storeReducer;
