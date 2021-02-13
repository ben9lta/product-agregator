import React from 'react';
import './index.scss';

const Footer = () => {
    return (
        <footer className="sticky-footer">
            <div className="container">
                <div className="row">
                    <div className="col-md-6">
                        <h2>Покупателям</h2>
                        <ul>
                            <li><a href="#">Как заказывать</a></li>
                            <li><a href="#">Доставка и оплата</a></li>
                            <li><a href="#">Возврат товара</a></li>
                            <li><a href="#">Пользовательское соглашение</a></li>
                            <li><a href="#">Согласие на обработку персональных данных</a></li>
                            <li><a href="#">Личный кабинет</a></li>
                        </ul>
                    </div>
                    <div className="col-md-6">
                        <h2>О нас</h2>
                        <ul>
                            <li><a href="#">Контакты</a></li>
                        </ul>
                    </div>
                </div>
                <div className="text-center">
                    Copyright © {'Продукты в Ялте, ' + new Date().getFullYear()}
                </div>
            </div>
        </footer>
    )
}

export default Footer;
