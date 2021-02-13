import {ADD_CATEGORIES} from "../actions/actionTypes";

const initialState = {
    categories: [],
}

const categoryReducer = (state = initialState, {type, payload}) => {
    switch (type) {
        case ADD_CATEGORIES:
            return {
                ...state,
                categories: payload,
            }
        default:
            return state;
    }
}

export default categoryReducer;
