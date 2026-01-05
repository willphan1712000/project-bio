import CreateAnother from './CreateAnother';
import Delete from './Delete/Delete';
import Signout from './Signout';
import TemplateButton from './TemplateButton';

const Utilities = () => {
    return (
        <div className="flex flex-row items-center gap-3 px-2 overflow-auto [&::-webkit-scrollbar]:hidden [-ms-overflow-style:'none'] [scrollbar-width:'none']'">
            <TemplateButton />
            <CreateAnother />
            <Delete />
            <Signout />
        </div>
    );
};

export default Utilities;
