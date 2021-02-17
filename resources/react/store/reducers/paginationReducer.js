import {ADD_PAGINATION} from "../actions/actionTypes";

const initialState = {
    pagination: {},
}

const paginationReducer = (state = initialState, {type, payload}) => {
    switch (type) {
        case ADD_PAGINATION:
            return {
                ...state,
                pagination: payload
            }
        default:
            return state;
    }
}

export default paginationReducer;
