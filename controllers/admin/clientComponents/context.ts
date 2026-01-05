import { createContext, useContext } from 'react';
import { UserSignin } from '../../client/auth/auth';

export type Data = UserSignin;

export type ContextDataType =
    | [Data, React.Dispatch<React.SetStateAction<Data>>]
    | undefined;

export const MyContext = createContext<Data>(undefined);

export default function useMyContext() {
    const data = useContext(MyContext);

    if (data === undefined) throw new Error('Context admin is undefined');

    return data;
}
