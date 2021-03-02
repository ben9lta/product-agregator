import React from 'react';
import CartItems from "./_items";
import {connect} from "react-redux";
import orderService from "../../api/services/orderService";
import './index.scss'

const Cart = ({cart, handleClickCart}) => {
    const user = window.user;
    const [hiddenForm, setHiddenForm] = React.useState(true);
    const [orderData, setOrderData] = React.useState({
        name: '',
        phone: '',
        address: '',
    });
    const formRef = React.useRef(null);

    const handleInputChange = (e) => {
        setOrderData({...orderData, [e.target.name]: e.target.value})
    }

    const handleSubmitForm = (e) => {
        e.preventDefault();
        return createOrder(orderData);
    }

    const handleCreateOrder = () => {
        if(user) {
            return createOrder();
        } else {
            setHiddenForm(!hiddenForm);
        }

    }

    const createOrder = (data = {}) => {
        return orderService.createOrder(data).then(() => {
            localStorage.setItem('token', Math.random());
            location.href = '/';
        });
    }

    return (
        <div className="checkout">
            <div className="clearfix">
                <div className="cart-header" style={{justifyContent: hiddenForm ? 'flex-end' : 'space-between'}} >
                    <span className="cart__icon" style={{paddingRight: '10px'}} hidden={hiddenForm} onClick={() => setHiddenForm(!hiddenForm)}>
                        <svg width="12" height="14" viewBox="0 0 12 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11 1L2 10.5L11 20" stroke="#294053" strokeWidth="1.56897"></path>
                        </svg>
                    </span>
                    <span className="cart__icon" onClick={handleClickCart}>
                        <svg version="1.1" viewBox="0 0 512 512" className="close-icon svg-icon svg-fill" style={{width: '1em', height: '1em'}}>
                            <path pid="0" d="M505.943 6.058c-8.077-8.077-21.172-8.077-29.249 0L6.058 476.693c-8.077 8.077-8.077 21.172 0 29.249A20.612 20.612 0 0 0 20.683 512a20.614 20.614 0 0 0 14.625-6.059L505.943 35.306c8.076-8.076 8.076-21.171 0-29.248z"></path>
                            <path pid="1" d="M505.942 476.694L35.306 6.059c-8.076-8.077-21.172-8.077-29.248 0-8.077 8.076-8.077 21.171 0 29.248l470.636 470.636a20.616 20.616 0 0 0 14.625 6.058 20.615 20.615 0 0 0 14.624-6.057c8.075-8.078 8.075-21.173-.001-29.25z"></path>
                        </svg>
                    </span>
                </div>
                <div className="cart-products" hidden={!hiddenForm}>
                    <CartItems products={cart.products}/>
                </div>
                <div className={'order-form'} hidden={hiddenForm}>
                    <strong>Для оформления заказа необходимо ввести следующие данные:</strong>
                    <p>{'* - обязательно для заполнения'}</p>
                    <form onSubmit={handleSubmitForm}>
                        <label htmlFor="order-name">ФИО*</label>
                        <input type="text" name={'name'} id={'order-name'} onChange={handleInputChange} required={true}/>
                        <label htmlFor="order-phone">Телефон*</label>
                        <input type="text" name={'phone'} id={'order-phone'} onChange={handleInputChange} required={true}/>
                        <label htmlFor="order-address">Адрес</label>
                        <input type="text" name={'address'} id={'order-address'} onChange={handleInputChange} />

                        <input type="submit" hidden={true} ref={formRef} />
                    </form>
                </div>

                <hr/>
                <div className={'cart-footer'}>
                    <div className="clearfix">
                        <div className="cart-block cart-block-footer clearfix">
                            <div>
                                <strong>Сумма:</strong>
                                <span>{cart.total} руб.</span>
                            </div>
                        </div>
                    </div>
                    {cart.products.length > 0 && (
                        <div className="cart-block-buttons">
                            <button
                                className="submit-btn btn-active-color"
                                onClick={hiddenForm ? handleCreateOrder : () => formRef.current.click()}
                            >
                                Оформить заказ
                            </button>
                        </div>
                    )}
                </div>

            </div>

        </div>
    );
}

const mapStateToProps = (state) => {
    return {
        cart: state.cartReducer.cart,
    }
}

export default connect(mapStateToProps, {})(Cart);
