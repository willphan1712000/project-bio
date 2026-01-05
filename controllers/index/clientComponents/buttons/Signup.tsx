import { Button } from '@willphan1712000/frontend';

interface Props {
    content: string;
}

const Signup = ({ ...otherProps }: Props) => {
    return (
        <Button
            {...otherProps}
            onClick={() => (window.location.href = '/@signup')}
            buttonType="solid"
        />
    );
};

export default Signup;
