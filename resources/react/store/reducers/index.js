import {combineReducers} from "redux";
import productReducer from './productReducer';
import categoryReducer from './categoryReducer';
import storeReducer from './storeReducer';
import paginationReducer from './paginationReducer';

export default combineReducers({
    productReducer,
    categoryReducer,
    storeReducer,
    paginationReducer
});
