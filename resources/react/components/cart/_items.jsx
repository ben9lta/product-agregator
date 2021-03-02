import React from 'react';
import './_items.scss';
import cartService from "../../api/services/cartService";
import {cartActions, toastActions} from "../../store/actions";
import {useDispatch} from "react-redux";

const CartItem = ({products}) => {
    const dispatch = useDispatch();
    const [isReady, setIsReady] = React.useState(true);
    const [quantityData, setQuantityData] = React.useState({
        quantity: null,
        product_id: null,
    });

    React.useEffect(() => {

        if(quantityData.product_id) {
            const delayToSendData = setTimeout(async () => {
                await cartService.updateQuantity(quantityData);
                const {data} = await cartService.getCart();
                dispatch(cartActions.setCart(data.data))
            }, 250);

            return () => clearTimeout(delayToSendData);
        }

    }, [quantityData]);

    const deleteProduct = async (e) => {
        setIsReady(false);
        e.preventDefault();
        const product_id = e.currentTarget.dataset.id;
        await cartService.deleteProduct(product_id);
        dispatch(toastActions.setMessage(''));
        const {data} = await cartService.getCart();
        dispatch(cartActions.setCart(data.data))
        setIsReady(true);
    }

    const updateQuantity = async (e) => {
        e.preventDefault();
        const product_id = e.target.dataset.id;
        const quantity = e.target.value;
        setQuantityData({product_id, quantity});
    }

    return (
        <React.Fragment>
            {products.length > 0 && products.map((product, key) => {
                return (
                    <div className="cart-block cart-block-item clearfix" key={key}>
                        <div className="image">
                            <img src={product.imageUrl} alt="image" />
                        </div>
                        <div className="product__title">
                            <p>{product.name}</p>
                            <small>Product category</small>
                        </div>
                        <div className="product__quantity">
                            <input type="number" min={1}
                                   data-id={product.id}
                                   defaultValue={product.pivot.quantity}
                                   onChange={updateQuantity}
                                   name={'product-quantity'}
                                   className="form-control form-quantity" />
                        </div>
                        <div className="product__price">
                            <span className="final">{product.price * product.pivot.quantity} руб.</span>
                            <span className="old">{product.old_price ? product.old_price + ' руб.' : ''}</span>
                        </div>
                        <span className="item-delete" data-id={product.id} onClick={isReady ? deleteProduct : null}>
                            <svg version="1.1" viewBox="0 0 512 512" className="icon-delete">
                                <path pid="0" d="M505.943 6.058c-8.077-8.077-21.172-8.077-29.249 0L6.058 476.693c-8.077 8.077-8.077 21.172 0 29.249A20.612 20.612 0 0 0 20.683 512a20.614 20.614 0 0 0 14.625-6.059L505.943 35.306c8.076-8.076 8.076-21.171 0-29.248z"></path>
                                <path pid="1" d="M505.942 476.694L35.306 6.059c-8.076-8.077-21.172-8.077-29.248 0-8.077 8.076-8.077 21.171 0 29.248l470.636 470.636a20.616 20.616 0 0 0 14.625 6.058 20.615 20.615 0 0 0 14.624-6.057c8.075-8.078 8.075-21.173-.001-29.25z"></path>
                            </svg>
                        </span>
                    </div>
                )
            })}
            {products.length < 1 && (
                <>
                    <h5 className={'mt-4 ml-2'}>Пусто</h5>
                </>
            )}
        </React.Fragment>
    )
}

export default CartItem;
