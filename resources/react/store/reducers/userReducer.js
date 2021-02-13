import {ADD_USER} from "../actions/actionTypes";

const initialState = {
    user: {},
}

const userReducer = (state = initialState, {type, payload}) => {
    switch (type) {
        case ADD_USER:
            return {
                ...state,
                user: payload
            }
        default:
            return state;
    }
}

export default userReducer;
