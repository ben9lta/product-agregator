import {SET_TOAST_MESSAGE} from "./actionTypes";

export const toastActions = {
    setMessage: (message) => ({
        type: SET_TOAST_MESSAGE,
        payload: message
    }),
}

