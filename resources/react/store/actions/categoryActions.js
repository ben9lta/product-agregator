import {ADD_CATEGORIES} from "./actionTypes";

export const categoryActions = {
    setCategories: (categories) => ({
        type: ADD_CATEGORIES,
        payload: categories
    }),
}

