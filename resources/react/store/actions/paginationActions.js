import {ADD_PAGINATION} from "./actionTypes";

export const paginationActions = {
    setPagination: (pagination) => ({
        type: ADD_PAGINATION,
        payload: pagination
    }),
}
