import React from 'react';
import './index.scss';

export const Spinner = ({style = {}, size = null}) => {
    const styleSize = (size) => {
        switch (size) {
            case 'small':
                return 'spinner-border-sm';
            default:
                return null;
        }
    }

    return (
        <div className={size ? `spinner-border text-warning ${styleSize(size)}` : "spinner-border text-warning"}
             role="status"
             style={style}
        >
            <span className="sr-only">Loading...</span>
        </div>
    )
}
