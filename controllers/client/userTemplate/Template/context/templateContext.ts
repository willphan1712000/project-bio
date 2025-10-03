import { createContext, useContext } from "react";
import { Template_User } from "../../api/template";

export type Data = {
    data: Template_User,
}

export type ContextDataType = Data | undefined

/**
 * This holds context for the entire template data fetched from database and update it
 */
export const MyContext = createContext<ContextDataType>(undefined)

export default function useMyContext() {
    const data = useContext(MyContext)

    if ( data === undefined )
        throw new Error("Template container context is undefined")
        
    return data
}