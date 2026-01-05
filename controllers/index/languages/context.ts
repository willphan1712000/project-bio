import { createContext, useContext } from "react";
import Language from "./interface";

type ContextDataType = [
    Language,
    React.Dispatch<React.SetStateAction<Language>>
] | undefined

/**
 * Language context provider
 */
export const LanguageContext = createContext<ContextDataType>(undefined)

/**
 * Provide language context that delivers desired language to all components
 * @returns language context
 */
export default function useLanguageContext() {
    const data = useContext(LanguageContext)

    if ( data === undefined )
        throw new Error("Context is undefined")
        
    return data
}