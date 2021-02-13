import {ADD_STORE} from "./actionTypes";

export const storeActions = {
    setStores: (stores) => ({
        type: ADD_STORE,
        payload: stores
    }),
}

