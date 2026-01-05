import { ReactNode, useState } from 'react';
import { BiFontSize } from 'react-icons/bi';
import { IoIosColorPalette } from 'react-icons/io';
import { ImFont } from 'react-icons/im';
import { nameType } from '../../Tools';
import { Raw_Info } from '../../../../../types/User';
import Font from './Font';
import Color from './Color';
import FontSize from './FontSize';
import { styles } from './styles';

interface Props {
    name: nameType;
    userInfo: Raw_Info;
    setUserInfo: React.Dispatch<React.SetStateAction<Raw_Info | undefined>>;
}

const TextBox = ({ name, userInfo, setUserInfo }: Props) => {
    const [tool, setTool] = useState<number>(-1);
    const textBoxTools = ['Font Size', 'Font', 'Font color'];
    const iconTools: ReactNode[] = [
        <BiFontSize size="30" />,
        <ImFont size="30" />,
        <IoIosColorPalette size="30" />,
    ];
    const tools: ReactNode[] = [<FontSize />, <Font />, <Color />];

    return (
        <div style={styles.container}>
            <div style={styles.tool}>{tool > -1 && tools[tool]}</div>
            <div style={styles.optionContainer}>
                {textBoxTools.map((tool, idx) => (
                    <div
                        key={idx}
                        style={styles.option}
                        onClick={() => setTool(idx)}
                    >
                        {iconTools[idx]}
                        <span>{tool}</span>
                    </div>
                ))}
            </div>
        </div>
    );
};

export default TextBox;
