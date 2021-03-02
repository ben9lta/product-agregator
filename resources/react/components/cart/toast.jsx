import React from 'react';
import {connect} from "react-redux";

const Toast = ({toastMessage}) => {
    React.useEffect(() => {
        $('.toast').toast('show');
    }, [toastMessage]);

    if(!toastMessage) return null;

    return (
        <div role="alert" aria-live="assertive" aria-atomic="true" className="toast" data-autohide="true" data-delay={2500}>
            <div className="toast-header">
                    <strong className="mr-auto">Сообщение</strong>
                    <button type="button" className="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div className="toast-body">
                {toastMessage}
            </div>
        </div>
    );
}

const mapStateToProps = (state) => {
    return {
        toastMessage: state.toastReducer.message,
    }
}

export default connect(mapStateToProps, {})(Toast);
