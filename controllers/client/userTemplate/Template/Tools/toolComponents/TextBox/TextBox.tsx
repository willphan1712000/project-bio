import { ReactNode } from "react";
import { BiFontSize } from "react-icons/bi";
import { IoIosColorPalette } from "react-icons/io";
import { ImFont } from "react-icons/im";
import { nameType } from "../../Tools";
import { Raw_Info } from "../../../../../types/User";

interface Props {
    name: nameType,
    userInfo: Raw_Info,
    setUserInfo: React.Dispatch<React.SetStateAction<Raw_Info | undefined>>
}

const TextBox = ({ name, userInfo, setUserInfo }: Props) => {
    const textBoxTools = ["Font Size", "Font", "Font color"]
    const iconTools: ReactNode[] = [
        <BiFontSize size="30"/>,
        <ImFont size="30"/>,
        <IoIosColorPalette size="30"/>,
    ]

  return (
    <div style={{
        width: '100%',
        display: 'flex',
        flexDirection: 'column',
        justifyContent: 'center',
        alignItems: 'center',
        gap: '5px',
    }}>
        <div style={{
            height: '35px' // reserve space for tools of textbox 
        }}>

        </div>
        <div style={{
            display: 'flex',
            flexDirection: 'row',
            justifyContent: 'center',
            alignItems: 'center',
            gap: '15px',
        }}>
            {textBoxTools.map((tool, idx) => (
                <div key={idx} style={{
                    display: 'flex',
                    flexDirection: 'row',
                    gap: '5px',
                    justifyContent: 'center',
                    alignItems: 'center',
                    padding: '8px',
                    background: '#f0f0f7',
                    borderRadius: '30px',
                    fontSize: '15px',
                    cursor: 'pointer',
                }}>
                    {iconTools[idx]}
                    <span>{tool}</span>
                </div>
            ))}
        </div>
    </div>
  )
}

export default TextBox