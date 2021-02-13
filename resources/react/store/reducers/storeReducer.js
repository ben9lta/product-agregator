import {ADD_STORE} from "../actions/actionTypes";

const initialState = {
    stores: [],
}

const storeReducer = (state = initialState, {type, payload}) => {
    switch (type) {
        case ADD_STORE:
            return {
                ...state,
                stores: payload,
            }
        default:
            return state;
    }
}

export default storeReducer;
