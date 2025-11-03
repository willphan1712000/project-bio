import { useEffect, useState } from 'react';
import { Raw_Info } from '../../../../types/User';
import { nameType } from '../Tools';

interface Props {
    name: nameType,
    userInfo: Raw_Info,
    setUserInfo: React.Dispatch<React.SetStateAction<Raw_Info | undefined>>
}

const IconBox = ({ name, userInfo, setUserInfo }: Props) => {
    const [value, setValue] = useState<string | undefined>(undefined)

    function handleChange(e : React.ChangeEvent<HTMLInputElement>) {
        setValue(e.target.value)
        setUserInfo(prev => {
            return {
                ...prev,
                [name]: e.target.value
            }
        })
    }

    useEffect(() => {
        setValue(userInfo[name])
    }, [name])

    return (
        <div style={{
            width: '100%',
            display: 'flex',
            justifyContent: 'center',
            alignItems: 'center',
            gap: '5px',
            padding: '20px'
        }}>
            <span>{name}</span>
            <input style={{
                    width: '100%',
                    maxWidth: '500px'
                }}
                type='text' 
                placeholder=''
                value={value ?? ""}
                onChange={handleChange}
                id="IconBox"
            />
        </div>
    )
}

export default IconBox