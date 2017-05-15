<?php

namespace Sajari;

class Schema
{
    private $grpcSchemaClient;
    private $callMeta;

    /**
     * Create a Schema Client.
     * @param Engine\Schema\SchemaClient $grpcSchemaClient Schema grpc Client.
     * @param array $callMeta Array of meta data to send with requests.
     */
    public function __construct(
        Engine\Schema\SchemaClient $grpcSchemaClient,
        array $callMeta
    )
    {
        $this->grpcSchemaClient = $grpcSchemaClient;
        $this->callMeta = $callMeta;
    }

    /**
     * Gets a list of the fields defined in the schema.
     * @return Field[] List of fields defining the schema.
     */
    public function getFields()
    {
        /** @var \Sajari\Engine\Schema\Fields $reply */
        list($reply, $status) = $this->grpcSchemaClient->GetFields(
            new Rpc\PBEmpty(),
            $this->callMeta
        )->wait();

        Internal\Status::checkForError(
            new Status($status->code, $status->details)
        );

        $fields = [];
        foreach ($reply->getFields() as $field) {
            $fields[] = Internal\Field::fromProto($field);
        }
        return $fields;
    }

    /**
     * Add fields to the schema.
     * @param Schema\Field[] $fields
     * @return Status[] Array of Status objects.
     */
    public function addFields(array $fields)
    {
        $protoFields = new Engine\Schema\Fields();
        foreach ($fields as $field) {
            $protoFields->getFields()[] = Internal\Field::toProto($field);
        }

        /** @var \sajariGen\engine\schema\Response $reply */
        list($resp, $status) = $this->grpcSchemaClient->AddFields(
            $protoFields,
            $this->callMeta
        )->wait();

        Internal\Status::checkForError(
            new Status($status->code, $status->details)
        );

        return Internal\Status::fromProtoStatuses($resp->getStatus());
    }

    /**
     * @param Schema\MutateFieldRequest $request
     * @return Schema\Response
     */
    public function mutateFields(Schema\MutateFieldRequest $request)
    {
        /** @var \sajariGen\engine\schema\Response $reply */
        list($reply, $status) = $this->grpcSchemaClient->MutateFields(
            $request->proto(),
            $this->callMeta
        )->wait();

        Internal\Status::checkForError($status);

        return Schema\Response::fromProto($reply);
    }
}
