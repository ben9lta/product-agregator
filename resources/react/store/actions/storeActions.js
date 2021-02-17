import {ADD_STORES, ADD_SELECTED_STORES} from "./actionTypes";

export const storeActions = {
    setStores: (stores) => ({
        type: ADD_STORES,
        payload: stores
    }),
    setSelectedStores: (stores) => ({
        type: ADD_SELECTED_STORES,
        payload: stores
    }),
}

