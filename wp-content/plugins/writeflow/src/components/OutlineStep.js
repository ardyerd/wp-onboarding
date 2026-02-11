import { TextareaControl, Button, Spinner } from "@wordpress/components";
import { useDispatch, useSelect } from "@wordpress/data";
import apiFetch from "@wordpress/api-fetch";
import { useState } from "@wordpress/element";

const OutlineStep = ( { onNext, onBack } ) => {
    const meta = useSelect( ( select ) => select( 'core/editor' ).getEditedPostAttribute( 'meta' ) );

    const { editPost } = useDispatch( 'core/editor' );
    const [ isLoading, setIsLoading ] = useState( false );

    const generateOutline = async () => {
        setIsLoading( true );
        
        const response = await apiFetch( {
            path: '/wp/v1/writeflow/generate-outline',
            method: 'POST',
            data: {
                idea: meta._writeflow_idea,
            },
        } );

        editPost( { meta: { ...meta, _writeflow_outline: response.outline } } );
        setIsLoading( false );
    };        

    return (
        <>
            <TextareaControl
                label="Create your outline: (use bullet points)"
                value={ meta._writeflow_outline || '' }
                onChange={(value) => 
                    editPost({ meta: { ...meta, _writeflow_outline: value } })
                }
            />
            <Button variant="secondary" onClick={onBack} style={{ marginRight: '8px' }}>← Back to Ideas</Button>
            <Button variant="secondary" onClick={generateOutline} disabled={isLoading} style={{ marginRight: '8px' }}>
                { isLoading ? <Spinner /> : '[AI] Generate Outline' }
            </Button>
            <Button variant="primary" onClick={onNext}>Start Drafting →</Button>
        </>
    );
};
export default OutlineStep;