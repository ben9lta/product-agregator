import React from 'react';
import {connect} from "react-redux";

const Products = ({products, title}) => {
    return (
        <div className="products">
            <h2 className="products__title">{title || 'Продукты'}</h2>
            <div className="items">
                {products.length > 0 && products.map((product) => {
                    return (
                        <div className="product__item" key={product.id}>
                            <img src={product.imageUrl} alt={product.name} className="product__img"/>
                            <div className="wrapper">
                                <div className="product-info">
                                    <p className="product__title">{product.name}</p>
                                    <span className="product__store">{product.store.name}</span>
                                </div>
                                <div className="product__footer">
                                    <div className="price-info">
                                        <span
                                            className="old-price">{product.old_price ? product.old_price + 'руб.' : ''}</span>
                                        <span className="price">{product.price} руб.</span>
                                    </div>
                                    <div className="btn-wrapper">
                                        <div className="btn-cart">
                                            <span>+</span>
                                            <svg width="22" height="18" viewBox="0 0 22 18" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M1.875 1.33499H4.15625L6.4375 11.9993H18.1696L20.125 4.6676H6.4375"
                                                    stroke="#F0F0F0" strokeWidth="2" strokeLinecap="round"
                                                    strokeLinejoin="round"/>
                                                <ellipse cx="9.04469" cy="14.9987" rx="1.62946" ry="1.6663"
                                                         stroke="#F0F0F0" strokeWidth="2"/>
                                                <ellipse cx="15.5625" cy="14.9987" rx="1.62946" ry="1.6663"
                                                         stroke="#F0F0F0" strokeWidth="2"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    );
                })}
            </div>
        </div>
    )
}


const mapStateToProps = (state) => {
    return {
        products: state.productReducer.products,
    }
}

export default connect(mapStateToProps, {})(Products);
// export default Products;
