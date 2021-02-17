import {ADD_CATEGORIES, ADD_CURRENT_CATEGORY} from "../actions/actionTypes";

const initialState = {
    categories: [],
    currentCategory: 'Продукты',
}

const categoryReducer = (state = initialState, {type, payload}) => {
    switch (type) {
        case ADD_CATEGORIES:
            return {
                ...state,
                categories: payload,
            }
        case ADD_CURRENT_CATEGORY:
            return {
                ...state,
                currentCategory: payload
            }
        default:
            return state;
    }
}

export default categoryReducer;
