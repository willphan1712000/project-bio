export const styles: {[K in | 'container' | 'tool' | 'optionContainer' | 'option']: React.CSSProperties} = Object.freeze({
    container: {
        width: '100%',
        display: 'flex',
        flexDirection: 'column',
        justifyContent: 'center',
        alignItems: 'center',
        gap: '5px',
    },
    tool: {
        height: '35px', // reserve space for tools of textbox 
        display: 'flex',
        justifyContent: 'center',
        alignItems: 'center'
    },
    optionContainer: {
        display: 'flex',
        flexDirection: 'row',
        justifyContent: 'center',
        alignItems: 'center',
        gap: '15px',
    },
    option: {
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
    }
})