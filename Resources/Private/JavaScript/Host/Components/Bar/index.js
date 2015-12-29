import React, {Component, PropTypes} from 'react';
import mergeClassNames from 'classnames';
import style from './style.css';

export default class Bar extends Component {
    static propTypes = {
        position: PropTypes.oneOf(['top', 'left', 'bottom']).isRequired,
        className: PropTypes.string,
        children: PropTypes.node,

        onDrop: PropTypes.func
    }

    render() {
        const {position, className} = this.props;
        const classNames = mergeClassNames({
            [className]: true,
            [style.bar]: true,
            [style.top]: position === 'top',
            [style.left]: position === 'left',
            [style.bottom]: position === 'bottom'
        });

        return (
            <div className={classNames} onDragOver={e => e.preventDefault()} onDrop={e => this.onDrop(e)}>
              {this.props.children}
            </div>
        );
    }

    onDrop(e) {
        const {onDrop} = this.props;

        onDrop(e);

        e.stopPropagation();
    }
}