import React from 'react';
import './success.scss';
import SuccessImg from './images/success.png';

const SuccessOrder = () => {
    const [seconds, setSeconds] = React.useState(5);

    React.useEffect(() => {
        if (seconds > 0) {
            localStorage.removeItem('orderSuccess');
            setTimeout(() => setSeconds(seconds - 1), 1000);
        } else {
            location.href = '/';
        }

    }, [seconds]);

    return (
        <div className={'success-order'}>
            <header>
                <h2>СПАСИБО ЗА ЗАКАЗ</h2>
            </header>
            <main>
                <img src={SuccessImg} alt={'success'} />
                <p>Ваша заявка принята и отправлена на обработку.</p>
            </main>
            <span>Перенаправление через: <b>{seconds}</b></span>
            <a href={'/'}>Перейти на главную</a>
        </div>
    )
}

export default SuccessOrder;
