import {ADD_CATEGORIES, ADD_CURRENT_CATEGORY} from "./actionTypes";

export const categoryActions = {
    setCategories: (categories) => ({
        type: ADD_CATEGORIES,
        payload: categories
    }),
    setCurrentCategory: (category) => ({
        type: ADD_CURRENT_CATEGORY,
        payload: category
    })
}

