import { ReactNode } from 'react';

type Props = React.HTMLAttributes<HTMLDivElement> & {
    children?: ReactNode;
    style?: React.CSSProperties;
};

/**
 *
 * @returns App Button decorator
 */
const AppButton = ({ children, style, ...props }: Props) => {
    return (
        <div
            style={{
                display: 'flex',
                justifyContent: 'center',
                alignItems: 'center',
                borderRadius: '30px',
                backgroundColor: '#e2e2e2',
                width: 'fit-content',
                color: '#000',
                height: '40px',
                overflow: 'hidden',
                flexShrink: 0,
                ...style,
            }}
            {...props}
        >
            {children}
        </div>
    );
};

export default AppButton;
