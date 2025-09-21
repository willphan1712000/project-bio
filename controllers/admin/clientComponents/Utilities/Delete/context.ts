import { createContext, useContext } from "react";

export type Data = {
    isDeleteWarningOpen: boolean
}

export type ContextDataType = [
    Data,
    React.Dispatch<React.SetStateAction<Data>>
] | undefined

export const MyContext = createContext<ContextDataType>(undefined)

export default function useMyContext() {
    const data = useContext(MyContext)

    if ( data === undefined )
        throw new Error("Delete button context is undefined")
        
    return data
}