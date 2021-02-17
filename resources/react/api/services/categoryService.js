import React from 'react';
import axios from "axios";
import {categoryActions} from "../../store/actions";

const categoryService = {
    fetch: async () => {
        try {
            const response = await axios.get('/api/categories');
            let categories = [];
            response.data.data.map(category => {
                categories.push({
                    id: category.id,
                    name: category.name,
                })
            })
            return categories;
        } catch (e) {
            console.error(e);
            return [];
        }
    }

}

export default categoryService;
