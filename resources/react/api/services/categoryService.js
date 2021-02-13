import React from 'react';
import axios from "axios";
import {categoryActions} from "../../store/actions";

const categoryService = {
    fetchAndSave: (dispatch) => {
        axios.get('/api/categories').then((response) => {
            let categories = [];
            response.data.data.map(category => {
                categories.push({
                    id: category.id,
                    name: category.name,
                })
            })
            dispatch(categoryActions.setCategories(categories));

        }).catch((error) => {
            console.log(error)
            dispatch(categoryActions.setCategories([]));
        })

    }

}

export default categoryService;
