import {combineReducers} from "redux";
import productReducer from './productReducer';
import categoryReducer from './categoryReducer';
import storeReducer from './storeReducer';
import paginationReducer from './paginationReducer';
import cartReducer from './cartReducer';
import toastReducer from './toastReducer';

export default combineReducers({
    productReducer,
    categoryReducer,
    storeReducer,
    paginationReducer,
    cartReducer,
    toastReducer,
});
