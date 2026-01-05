import { Button } from '@willphan1712000/frontend';

interface Props {
    content: string;
}

const Template = ({ ...otherProps }: Props) => {
    return (
        <Button
            {...otherProps}
            onClick={() => (window.location.href = '/@template')}
            buttonType="gradient"
        />
    );
};

export default Template;
