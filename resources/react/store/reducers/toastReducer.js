import {SET_TOAST_MESSAGE} from "../actions/actionTypes";

const initialState = {
    message: '',
}

const toastReducer = (state = initialState, {type, payload}) => {
    switch (type) {
        case SET_TOAST_MESSAGE:
            return {
                ...state,
                message: payload,
            }
        default:
            return state;
    }
}

export default toastReducer;
