import { useEffect, useState } from 'react';
import {
    Raw_Info,
    UserInfo,
    UserPhone,
    UserSocial,
    User_Style,
} from '../../../types/User';
import useMyContext from '../context/context';
import useAppQuery from '../../../hooks/useAppQuery';
import apiTemplate from '../../api/template';
import IconBox from './toolComponents/IconBox';
import TextBox from './toolComponents/TextBox/TextBox';

export type nameType = UserInfo | UserSocial | UserPhone;

/**
 * Tools support three types of data
 * - Avatar
 * - Text
 * - Icon
 * @returns
 */
const Tools = () => {
    const { frontTemplateHTML } = useMyContext();
    const textField = ['name', 'position', 'organization', 'description'];

    const [avatar, touchAvatar] = useState<nameType | undefined>(undefined);
    const [text, touchText] = useState<nameType | undefined>(undefined);
    const [icon, touchIcon] = useState<nameType | undefined>(undefined);

    const { data } = useAppQuery('template_user', apiTemplate.getTemplate);

    const [userInfo, setUserInfo] = useState<Raw_Info | undefined>(undefined);
    const [userStyle, setUserStyle] = useState<User_Style | undefined>(
        undefined
    );

    const handleTap = (e: MouseEvent) => {
        const ele = e.target as HTMLElement;
        const name = ele.dataset.name as nameType;

        reset();

        if (textField.includes(name)) {
            touchText(name);
        } else if (name === 'image') {
            touchAvatar(name);
        } else {
            touchIcon(name);
        }
    };

    const reset = () => {
        touchAvatar(undefined);
        touchText(undefined);
        touchIcon(undefined);
    };

    /**
     * Using event delegation to track click event on element on the current template
     */
    useEffect(() => {
        if (frontTemplateHTML && data) {
            setUserInfo(data.raw_info);
            frontTemplateHTML.addEventListener('click', handleTap);

            return () => {
                frontTemplateHTML.removeEventListener('click', handleTap);
            };
        }
    }, [frontTemplateHTML, data]);

    return (
        <div
            style={{
                height: '100px', // reserve a space for tools
                width: '100%',
                display: 'flex',
                justifyContent: 'center',
                alignItems: 'center',
                backgroundColor: 'white',
                borderRadius: '30px',
                marginBottom: '10px',
            }}
        >
            {icon && userInfo && (
                <IconBox
                    name={icon}
                    userInfo={userInfo}
                    setUserInfo={setUserInfo}
                />
            )}
            {text && userInfo && (
                <TextBox
                    name={text}
                    userInfo={userInfo}
                    setUserInfo={setUserInfo}
                />
            )}

            {/* <button onClick={() => console.log(userInfo)}>Submit</button> */}
        </div>
    );
};

export default Tools;
